<?php
declare(strict_types=1);

namespace App\Lib;

use Cake\Core\Configure;
use Cake\View\View;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{
    /**
     * メール送信を行う（SMTP版）
     * 必須のパラメータは配列ではなく個別に渡しています
     *
     * @param string $toEmail 送信先メールアドレス
     * @param string $templateName メールテンプレートファイル名
     * @param string $subject メールタイトル
     * @param string $mimeType mime type 'text/plain', 'text/html'
     * @param array $options メール送信に必要な情報配列
     *
     * @return bool
     */
    public function sendMail(
        string $toEmail,
        string $templateName,
        string $subject,
        string $mimeType,
        array $options = []
    ): bool {

        // 送信元
        $fromEmail = $options['from'] ?? Configure::read("PHPMailer.username");

        // 署名
        $signature = $options['signature'] ?? '[CakePHP 4] ';

        // 送信元名前
        $fromName = $options['fromName'] ?? '管理画面';

        // テンプレート展開
        $content = $this->_setEmailTemplate($templateName, $options);

        try {
            $mailer = new PHPMailer(true);
            $mailer->CharSet = 'UTF-8';

            //Server settings
            $mailer->isSMTP();
            $mailer->Host = Configure::read("PHPMailer.host");
            $mailer->Port = Configure::read("PHPMailer.port");
            $mailer->SMTPAuth = true;   // SMTP authentication を有効に
            $mailer->Username = Configure::read("PHPMailer.username");
            $mailer->Password = Configure::read("PHPMailer.password");
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // 暗号化を有効に

            //Recipients
            $mailer->setFrom($fromEmail, $fromName);
            $mailer->addAddress($toEmail);

            // Content
            $mailer->isHTML($mimeType == 'text/html');
            $mailer->Subject = $signature . $subject;
            $mailer->Body = $content;
            //$mailer->SMTPDebug = SMTP::DEBUG_SERVER;

            return $mailer->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
        }

        return false;
    }

    /**
     * メール送信templateの展開
     *
     * @param string $templateName メールテンプレートファイル名
     * @param array $options メール送信に必要な情報配列
     *
     * @return string メールテンプレートを展開した文字列
     */
    private function _setEmailTemplate(string $templateName, array $options = []): string
    {
        $view = new View();
        foreach ($options as $key => $value) {
            $view->set($key, $value);
        }

        return $view->render('email/' . $templateName, false);
    }
}
