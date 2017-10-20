<?php
use SaltedHerring\Debugger;
use SaltedHerring\Recaptcha;

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
            ''
        )->setAttribute('placeholder', 'Name'));

        $fields->push(EmailField::create(
            'Email',
            ''
        )->setAttribute('placeholder', 'Email'));

        $fields->push(TextareaField::create(
            'Content',
            ''
        )->setAttribute('placeholder', 'Message'));

        $fields->push(CheckboxField::create(
            'ToBook',
            'I also like to book an appointment'
        ));

        $fields->push(TextField::create(
            'Appointed',
            ''
        )->setAttribute('type', 'datetime-local')->addExtraClass('hide'));

        $actions = new FieldList();
        $actions->push($btnSubmit = FormAction::create('doContact', 'Contact')->addExtraClass('strong-blue'));

        $btnSubmit->addExtraClass('g-recaptcha is-primary');
        $btnSubmit->setAttribute('data-sitekey', Config::inst()->get('GoogleAPIs','Recaptcha_sitekey'))->setAttribute('data-callback', 'recaptchaHandler');

        $required_fields = array(
            'Name',
            'Email',
            'Content'
        );

        $required = new RequiredFields($required_fields);

        parent::__construct($controller, 'ContactForm', $fields, $actions, $required);
        $this->setFormMethod('POST', true)
             ->setFormAction($controller->Link() . 'ContactForm')->addExtraClass('contact-form');
    }

    public function doContact($data, $form)
    {
        if (!empty($data['g-recaptcha-response']) && !empty($data['SecurityID']) && $data['SecurityID'] == Session::get('SecurityID')) {

            $response = Recaptcha::verify($data['g-recaptcha-response']);

            if ($response->success) {
                $email = new Email();
                $recipient = Config::inst()->get('Email', 'info_email');
                // $email->To = 'leochenftw@gmail.com,' . $recipient;
                $email->To  =   'leochenftw@gmail.com';
                $email->From = $data['Email'];//Config::inst()->get('Email', 'noreply_email');
                $email->Subject = 'Website enquiry';

                $content = '<h2>Website enquiry</h2>';
                $content .= '<p>Name: ' . $data['Name'] . '</p>';
                $content .= '<p>Email: ' . $data['Email'] . '</p>';
                if (!empty($data['Appointed'])) {
                    $content .= '<p>Preferred date of appointment: ' . $data['Appointed'] . '</p>';
                }
                $content .= '<p>'. str_replace("\n", '<br /><br />',  trim($data['Content'])) . '</p>';
                $email->Body = $content;
                $email->send();

                $this->sessionMessage('Thank you for your message! We will get back to you shortly.', 'notification is-success', false);
                return $this->controller->redirectBack();
            }

            $this->sessionMessage('Try again?', 'notification is-danger', false);
            return $this->controller->redirect('/?anchor=contact-form');
        }

        return Controller::curr()->httpError(400, 'not matching');
    }


}
