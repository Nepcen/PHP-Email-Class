# PHP Email Class

This class allows you to send email using the PHPMailer library with SMTP.

Made By [Nepcen](https://www.linkedin.com/in/yusufabacik/)

## Requirements
- [PHP](https://www.php.net/) 7.0 or later
- [PHPMailer library](https://github.com/PHPMailer/PHPMailer)

## Getting started

- Download this repo and move to your project.
- Download the latest version of PHPMailer from [here](https://github.com/PHPMailer/PHPMailer)
- Move the downloaded files to your project. (It is useful to update the files in the src folder in this repo.)
- Include the class in your script:

```php
require_once 'path/to/Email.php';
```

## Usage

### Sending an Email
To send an email, use the `sendMail()` method. This method takes the following parameters:

- **$to** (string) : The email address of the recipient.
- **$subject** (string) : The subject of the email.
- **$body** (string) : The body of the email.
- **$from** (string) : The email address of the sender.
- **$fromName** (string) : The name of the sender.
- **$attachments** (array) : An array of file paths of attachments.

```php
$email = new Email('smtp.example.com', 'username', 'password', '587', 'tls');

$to = "example@example.com";
$subject = "Test Email";
$body = "This is a test email sent using PHPMailer.";
$from = "sender@example.com";
$fromName = "Sender";
$attachments = ['/path/to/file1.jpg', '/path/to/file2.pdf'];

if($email->sendMail($to, $subject, $body, $from, $fromName, $attachments)) {
    echo "Email sent successfully with attachments.";
} else {
    echo "Failed to send email.";
}
```

## Contribution

You can always contribute to the class by making pull requests and adding more feature or fixing bugs.

## License

This class is open-sourced software licensed under the MIT license.
