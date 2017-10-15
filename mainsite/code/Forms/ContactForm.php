<?php
use SaltedHerring\Debugger;

class ContactForm extends Form
{
    public function __construct($controller)
    {
        $fields = new FieldList();
        // $fields->push(DropdownField::create(
        //     'EnquiryType',
        //     'Enquiry Type',
        //     array(
        //         'General enquiry'   =>  'General',
        //         'Accounts enquiry'  =>  'Accounts',
        //         'Support enquiry'   =>  'Support',
        //         'Sales enquiry'     =>  'Sales'
        //     )
        // ));

        $fields->push(TextField::create(
            'Name',
            'Your name'
        ));

        $fields->push(EmailField::create(
            'Email',
            'Email address'
        ));

        $fields->push(TextareaField::create(
            'Content',
            'Message body'
        ));

        $actions = new FieldList();
        $actions->push(FormAction::create('doContact', 'Contact')->addExtraClass('strong-blue'));

        $required_fields = array(
            'Name',
            'Email',
            'Content'
        );

        $required = new RequiredFields($required_fields);

        parent::__construct($controller, 'ContactForm', $fields, $actions,$required);
        $this->setFormMethod('POST', true)
             ->setFormAction($controller->Link() . 'ContactForm')->addExtraClass('contact-form');
    }

    public function doContact($data, $form)
    {
        if (!empty($data['SecurityID']) && $data['SecurityID'] == Session::get('SecurityID')) {
            $email = new Email();
            $type = !empty($data['EnquiryType']) ? $data['EnquiryType'] : 'General enquiry';
            $recipient = Config::inst()->get('Email', 'info_email');
            $email->To = 'leochenftw@gmail.com,' . $recipient;
            $email->From = $data['Email'];//Config::inst()->get('Email', 'noreply_email');
            $email->Subject = 'Website enquiry';

            $content = '<h2>' . $type . '</h2>';
            $content .= '<p>Name: ' . $data['Name'] . '</p>';
            $content .= '<p>Email: ' . $data['Email'] . '</p>';
            $content .= '<p>'. str_replace("\n", '<br /><br />',  trim($data['Content'])) . '</p>';
            $email->Body = $content;
            $email->send();

            $this->sessionMessage('Thank you for your feedback! We will get back to you shortly.', 'notification is-success', false);
            return $this->controller->redirect('/?anchor=ContactForm');
        }

        return Controller::curr()->httpError(400, 'not matching');
    }


}
