<?php
namespace Cryslo\Core;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 12/02/2016
 * Time: 16:31
 */
class Mail
{
	const CRLF = "\r\n";

	/**
	 * @param $from
	 * @param $cc
	 *
	 * @return string
	 */
	private static function buildTextHeaders($from, $cc)
	{
		$headers   = [];
		$headers[] = "From: " . $from;
		if ($cc) $headers[] = "CC: " . $cc;

		return implode(self::CRLF, $headers);
	}

	/**
	 * @param $args
	 *
	 * @return bool
	 */
	public static function send($args)
	{
		$to      = Request::getFromArray($args, 'to', false);
		$cc      = Request::getFromArray($args, 'cc', false);
		$from    = Request::getFromArray($args, 'from', 'noreply@cryslo.com');
//		$sender  = Request::getFromArray($args, 'sender', false);
		$subject = Request::getFromArray($args, 'subject', false);
		$text    = Request::getFromArray($args, 'text', false);
//        $html       = Request::getFromArray($args, 'html', false);

		if (is_array($to)) $to = implode(',', $to);


		try
		{
			mail($to, $subject, $text, self::buildTextHeaders($from, $cc));
			return true;
		}
		catch (\Exception $e)
		{
			return false;
		}

//        $boundary = '----=_NextPart_' . md5(time());
//
//        $header = '';
//
//        $header .= 'MIME-Version: 1.0' . $this->newline;
//
//        if ($this->protocol != 'mail') {
//            $header .= 'To: ' . $to . $this->newline;
//            $header .= 'Subject: ' . $this->subject . $this->newline;
//        }
//
//        $header .= 'Date: ' . date('D, d M Y H:i:s O') . $this->newline;
//        $header .= 'From: ' . '=?UTF-8?B?' . base64_encode($this->sender) . '?=' . '<' . $this->from . '>' . $this->newline;
//        $header .= 'Reply-To: ' . '=?UTF-8?B?' . base64_encode($this->sender) . '?=' . '<' . $this->from . '>' . $this->newline;
//        $header .= 'Return-Path: ' . $this->from . $this->newline;
//        $header .= 'X-Mailer: PHP/' . phpversion() . $this->newline;
//        $header .= 'Content-Type: multipart/related; boundary="' . $boundary . '"' . $this->newline . $this->newline;
//
//        if (!$this->html) {
//            $message  = '--' . $boundary . $this->newline;
//            $message .= 'Content-Type: text/plain; charset="utf-8"' . $this->newline;
//            $message .= 'Content-Transfer-Encoding: 8bit' . $this->newline . $this->newline;
//            $message .= $this->text . $this->newline;
//        } else {
//            $message  = '--' . $boundary . $this->newline;
//            $message .= 'Content-Type: multipart/alternative; boundary="' . $boundary . '_alt"' . $this->newline . $this->newline;
//            $message .= '--' . $boundary . '_alt' . $this->newline;
//            $message .= 'Content-Type: text/plain; charset="utf-8"' . $this->newline;
//            $message .= 'Content-Transfer-Encoding: 8bit' . $this->newline . $this->newline;
//
//            if ($this->text) {
//                $message .= $this->text . $this->newline;
//            } else {
//                $message .= 'This is a HTML email and your email client software does not support HTML email!' . $this->newline;
//            }
//
//            $message .= '--' . $boundary . '_alt' . $this->newline;
//            $message .= 'Content-Type: text/html; charset="utf-8"' . $this->newline;
//            $message .= 'Content-Transfer-Encoding: 8bit' . $this->newline . $this->newline;
//            $message .= $this->html . $this->newline;
//            $message .= '--' . $boundary . '_alt--' . $this->newline;
//        }
//
//        foreach ($this->attachments as $attachment) {
//            if (file_exists($attachment)) {
//                $handle = fopen($attachment, 'r');
//
//                $content = fread($handle, filesize($attachment));
//
//                fclose($handle);
//
//                $message .= '--' . $boundary . $this->newline;
//                $message .= 'Content-Type: application/octet-stream; name="' . basename($attachment) . '"' . $this->newline;
//                $message .= 'Content-Transfer-Encoding: base64' . $this->newline;
//                $message .= 'Content-Disposition: attachment; filename="' . basename($attachment) . '"' . $this->newline;
//                $message .= 'Content-ID: <' . basename(urlencode($attachment)) . '>' . $this->newline;
//                $message .= 'X-Attachment-Id: ' . basename(urlencode($attachment)) . $this->newline . $this->newline;
//                $message .= chunk_split(base64_encode($content));
//            }
//        }
//
//        $message .= '--' . $boundary . '--' . $this->newline;
//
//        if ($this->protocol == 'mail') {
//            ini_set('sendmail_from', $this->from);
//
//            if ($this->parameter) {
//                mail($to, '=?UTF-8?B?' . base64_encode($this->subject) . '?=', $message, $header, $this->parameter);
//            } else {
//                mail($to, '=?UTF-8?B?' . base64_encode($this->subject) . '?=', $message, $header);
//            }
//        } elseif ($this->protocol == 'smtp') {
//            $handle = fsockopen($this->hostname, $this->port, $errno, $errstr, $this->timeout);
//
//            if (!$handle) {
//                trigger_error('Error: ' . $errstr . ' (' . $errno . ')');
//                exit();
//            } else {
//                if (substr(PHP_OS, 0, 3) != 'WIN') {
//                    socket_set_timeout($handle, $this->timeout, 0);
//                }
//
//                while ($line = fgets($handle, 515)) {
//                    if (substr($line, 3, 1) == ' ') {
//                        break;
//                    }
//                }
//
//                if (substr($this->hostname, 0, 3) == 'tls') {
//                    fputs($handle, 'STARTTLS' . $this->crlf);
//
//                    while ($line = fgets($handle, 515)) {
//                        $reply .= $line;
//
//                        if (substr($line, 3, 1) == ' ') {
//                            break;
//                        }
//                    }
//
//                    if (substr($reply, 0, 3) != 220) {
//                        trigger_error('Error: STARTTLS not accepted from server!');
//                        exit();
//                    }
//                }
//
//                if (!empty($this->username)  && !empty($this->password)) {
//                    fputs($handle, 'EHLO ' . getenv('SERVER_NAME') . $this->crlf);
//
//                    $reply = '';
//
//                    while ($line = fgets($handle, 515)) {
//                        $reply .= $line;
//
//                        if (substr($line, 3, 1) == ' ') {
//                            break;
//                        }
//                    }
//
//                    if (substr($reply, 0, 3) != 250) {
//                        trigger_error('Error: EHLO not accepted from server!');
//                        exit();
//                    }
//
//                    fputs($handle, 'AUTH LOGIN' . $this->crlf);
//
//                    $reply = '';
//
//                    while ($line = fgets($handle, 515)) {
//                        $reply .= $line;
//
//                        if (substr($line, 3, 1) == ' ') {
//                            break;
//                        }
//                    }
//
//                    if (substr($reply, 0, 3) != 334) {
//                        trigger_error('Error: AUTH LOGIN not accepted from server!');
//                        exit();
//                    }
//
//                    fputs($handle, base64_encode($this->username) . $this->crlf);
//
//                    $reply = '';
//
//                    while ($line = fgets($handle, 515)) {
//                        $reply .= $line;
//
//                        if (substr($line, 3, 1) == ' ') {
//                            break;
//                        }
//                    }
//
//                    if (substr($reply, 0, 3) != 334) {
//                        trigger_error('Error: Username not accepted from server!');
//                        exit();
//                    }
//
//                    fputs($handle, base64_encode($this->password) . $this->crlf);
//
//                    $reply = '';
//
//                    while ($line = fgets($handle, 515)) {
//                        $reply .= $line;
//
//                        if (substr($line, 3, 1) == ' ') {
//                            break;
//                        }
//                    }
//
//                    if (substr($reply, 0, 3) != 235) {
//                        trigger_error('Error: Password not accepted from server!');
//                        exit();
//                    }
//                } else {
//                    fputs($handle, 'HELO ' . getenv('SERVER_NAME') . $this->crlf);
//
//                    $reply = '';
//
//                    while ($line = fgets($handle, 515)) {
//                        $reply .= $line;
//
//                        if (substr($line, 3, 1) == ' ') {
//                            break;
//                        }
//                    }
//
//                    if (substr($reply, 0, 3) != 250) {
//                        trigger_error('Error: HELO not accepted from server!');
//                        exit();
//                    }
//                }
//
//                if ($this->verp) {
//                    fputs($handle, 'MAIL FROM: <' . $this->from . '>XVERP' . $this->crlf);
//                } else {
//                    fputs($handle, 'MAIL FROM: <' . $this->from . '>' . $this->crlf);
//                }
//
//                $reply = '';
//
//                while ($line = fgets($handle, 515)) {
//                    $reply .= $line;
//
//                    if (substr($line, 3, 1) == ' ') {
//                        break;
//                    }
//                }
//
//                if (substr($reply, 0, 3) != 250) {
//                    trigger_error('Error: MAIL FROM not accepted from server!');
//                    exit();
//                }
//
//                if (!is_array($this->to)) {
//                    fputs($handle, 'RCPT TO: <' . $this->to . '>' . $this->crlf);
//
//                    $reply = '';
//
//                    while ($line = fgets($handle, 515)) {
//                        $reply .= $line;
//
//                        if (substr($line, 3, 1) == ' ') {
//                            break;
//                        }
//                    }
//
//                    if ((substr($reply, 0, 3) != 250) && (substr($reply, 0, 3) != 251)) {
//                        trigger_error('Error: RCPT TO not accepted from server!');
//                        exit();
//                    }
//                } else {
//                    foreach ($this->to as $recipient) {
//                        fputs($handle, 'RCPT TO: <' . $recipient . '>' . $this->crlf);
//
//                        $reply = '';
//
//                        while ($line = fgets($handle, 515)) {
//                            $reply .= $line;
//
//                            if (substr($line, 3, 1) == ' ') {
//                                break;
//                            }
//                        }
//
//                        if ((substr($reply, 0, 3) != 250) && (substr($reply, 0, 3) != 251)) {
//                            trigger_error('Error: RCPT TO not accepted from server!');
//                            exit();
//                        }
//                    }
//                }
//
//                fputs($handle, 'DATA' . $this->crlf);
//
//                $reply = '';
//
//                while ($line = fgets($handle, 515)) {
//                    $reply .= $line;
//
//                    if (substr($line, 3, 1) == ' ') {
//                        break;
//                    }
//                }
//
//                if (substr($reply, 0, 3) != 354) {
//                    trigger_error('Error: DATA not accepted from server!');
//                    exit();
//                }
//
//                // According to rfc 821 we should not send more than 1000 including the CRLF
//                $message = str_replace("\r\n", "\n",  $header . $message);
//                $message = str_replace("\r", "\n", $message);
//
//                $lines = explode("\n", $message);
//
//                foreach ($lines as $line) {
//                    $results = str_split($line, 998);
//
//                    foreach ($results as $result) {
//                        if (substr(PHP_OS, 0, 3) != 'WIN') {
//                            fputs($handle, $result . $this->crlf);
//                        } else {
//                            fputs($handle, str_replace("\n", "\r\n", $result) . $this->crlf);
//                        }
//                    }
//                }
//
//                fputs($handle, '.' . $this->crlf);
//
//                $reply = '';
//
//                while ($line = fgets($handle, 515)) {
//                    $reply .= $line;
//
//                    if (substr($line, 3, 1) == ' ') {
//                        break;
//                    }
//                }
//
//                if (substr($reply, 0, 3) != 250) {
//                    trigger_error('Error: DATA not accepted from server!');
//                    exit();
//                }
//
//                fputs($handle, 'QUIT' . $this->crlf);
//
//                $reply = '';
//
//                while ($line = fgets($handle, 515)) {
//                    $reply .= $line;
//
//                    if (substr($line, 3, 1) == ' ') {
//                        break;
//                    }
//                }
//
//                if (substr($reply, 0, 3) != 221) {
//                    trigger_error('Error: QUIT not accepted from server!');
//                    exit();
//                }
//
//                fclose($handle);
//            }
//        }
	}
}