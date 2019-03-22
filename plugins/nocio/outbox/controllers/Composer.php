<?php namespace Nocio\Outbox\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use ApplicationException;
use Lang;
use Form;
use Config;
use Mail;
use Input;
use Flash;
use Nocio\Outbox\Classes\RFC822;
use Nocio\Outbox\Models\Outmail;


class Composer extends Controller
{
    public $implement = [];

    public $formWidget;

    public $formConfig = 'config_form.yaml';
    
    public $requiredPermissions = [
        'nocio.outbox.access' 
    ];

    public $parser;

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Nocio.Outbox', 'composer');

        $this->pageTitle = 'Composer';
        $this->formConfig = $this->makeConfig($this->formConfig);
        $this->formConfig->arrayName = 'outmail';
        $this->formConfig->model = new Outmail();
        $this->formConfig->model->from = '"' . Config::get('mail.from.name') .
                                         '" <' . Config::get('mail.from.address') . '>';
        $this->formWidget = $this->makeWidget('Backend\Widgets\Form', $this->formConfig);

        $this->parser = new RFC822();
    }

    public function formRender($options = [])
    {
        if (!$this->formWidget) {
            throw new ApplicationException(Lang::get('backend::lang.form.behavior_not_ready'));
        }

        return $this->formWidget->render($options);
    }

    public function index() {
        // index action
    }

    public function parseAddressList($string, $validate = null) {
        $addresses = $this->parser->parseAddressList($string, '', false, $validate);

        // transform to October Mail format
        $list = [];
        foreach($addresses as $address) {
            $list[$address->mailbox . '@' . $address->host] = $address->personal;
        }

        return $list;
    }

    public function onSend() {
        if (! $data = Input::get('outmail')) {
            throw new ApplicationException('Invalid data');
        }

        $outmail = (object) $data;
        $parser = [$this, 'parseAddressList'];
        $vars = ['content' => $outmail->message];

        Mail::send('nocio.outbox::mail.template', $vars, function($message) use ($parser, $outmail) {
            // default fields
            $message->to($parser($outmail->to, true));
            $message->subject($outmail->subject);
            // optional fields
            foreach(['from', 'bcc', 'cc'] as $field) {
                if (!empty(trim($outmail->$field))) {
                    $message->$field($parser($outmail->$field));
                }
            }
        });

        Flash::success(Lang::get('nocio.outbox::lang.composer.sent_successfully'));
    }

}
