<?php
namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use Log;

trait MailsendTrait {


	public function sendConfirmationMail($email, $name) {

		Log::info("method called");
		Log::info($email);
		Mail::send('email-templates.reply-to-contact-us', ['user_email' => $email, 'user_name' => $name, 'pathToImage' => public_path() . "/assets/images/futurelogo.png"], function ($message) use ($email) {
			$message->from("custserv@futurestarr.com");
			$message->to("custserv@futurestarr.com");
			$message->subject("Welcome to FutureStarr");
		});

		// check for failures
		if (Mail::failures()) {
			return false;
		}
		Log::info("success");
	}

	public function sendContactRequestMailToAdmin($email, $name, $visitorUser) {

		Log::info("method called");
		Log::info($email);
		Mail::send('email-templates.contact-request-to-admin', ['user_email' => $email, 'user_name' => $name, 'visitorUser' => $visitorUser, 'pathToImage' => public_path() . "/assets/images/futurelogo.png"], function ($message) use ($email) {
			$message->from("custserv@futurestarr.com");
			$message->to($email);
			$message->subject("Welcome to FutureStarr");
		});

		// check for failures
		if (Mail::failures()) {
			return false;
		}
		Log::info("success");
	}
    public function sendReportRequestMailToAdmin($email, $name, $comment, $report_name, $report_email) {

		Log::info("method called");
		Log::info($email . ' ' . $name . ' ' . $comment . ' ' . $report_email . ' ' . $report_name);
		Mail::send('email-templates.social-buzz-report-to-admin', ['user_email' => $email, 'user_name' => $name, 'comment' => $comment, 'report_by' => $report_name, 'report_email' => $report_email, 'pathToImage' => public_path() . "/assets/images/futurelogo.png"], function ($message) use ($email) {
			$message->from($email);
			$message->to("custserv@futurestarr.com");
			$message->cc("custserv@futurestarr.com");
			$message->replyTo("custserv@futurestarr.com");
			$message->subject("Report to FutureStarr");
		});

		// check for failures
		if (Mail::failures()) {
			return false;
		}
		Log::info("success");
	}
	
    public function sendForgotPasswordMail($usr, $token) {
		$email = $usr->email;
		Mail::send('email-templates.forgot-password', ['usr' => $usr, 'token' => $token, 'pathToImage' => public_path() . "/assets/images/futurelogo.png"], function ($message) use ($email) {
			$message->from("custserv@futurestarr.com");
			$message->to($email);
			$message->subject("Reset your FutureStarr password");
		});

		// check for failures
		if (Mail::failures()) {
			return false;
		}
		return true;
	}
	public function talentApprovalMail($data) {
		// $email = 'custserv@futurestarr.com';
		// $email = 'praveen.patel@5exceptions.com';
		$email = array('custserv@futurestarr.com', 'futurestarr2012@yahoo.com', 'roshan@5exceptions.com');
		$data['pathToImage'] = public_path() . "/assets/images/futurelogo.png";
        
		Mail::send('email-templates.admin-talent-approval', $data, function ($message) use ($email) {
			$message->from("custserv@futurestarr.com");
			$message->to($email[0]);
			$message->cc($email[1]);
			$message->subject("New talent added");
		});

		// check for failures
		if (Mail::failures()) {
			return false;
		}
		return true;
	}
	public function sendEmailNotification($data) {
		$email = array('custserv@futurestarr.com', 'futurestarr2012@yahoo.com');
		$data['pathToImage'] = public_path() . "/assets/images/futurelogo.png";

		Mail::send('email-templates.seller-plan-notification', $data, function ($message) use ($email) {
			$message->from("custserv@futurestarr.com");
			$message->to($email[0]);
			$message->subject("FutureStarr - Commercial Ads Plan");
		});

		// check for failures
		if (Mail::failures()) {
			return false;
		}
		return true;
	}
	public function registerEmailToAdmin($data) {
        //dd($data);
		Log::info("method called");
		//Log::info($email);
		$email = array('custserv@futurestarr.com', 'futurestarr2012@yahoo.com');
		$data['pathToImage'] = public_path() . "/assets/images/futurelogo.png";
		Mail::send('email-templates.register', $data, function ($message) use ($email) {
			$message->from("custserv@futurestarr.com");
			$message->to($email);
			$message->subject("Welcome to FutureStarr");
		});

		// check for failures
		if (Mail::failures()) {
			return false;
		}
		Log::info("success");
	}
	public function registerEmailToBuyer($data, $userEmail) {

		Log::info("method called");
		Log::info($userEmail);
		$email = array('custserv@futurestarr.com', 'futurestarr2012@yahoo.com',$userEmail);
		$data['pathToImage'] = public_path() . "/assets/images/futurelogo.png";
		Mail::send('email-templates.buyer-register', $data, function ($message) use ($email) {
			$message->from("custserv@futurestarr.com");
			$message->to($email[2]);
			$message->subject("Welcome to FutureStarr");
		});

		// check for failures
		if (Mail::failures()) {
			return false;
		}
		Log::info("success");
	}
	public function registerEmailToSeller($data,$userEmail) {

		Log::info("method called");
		Log::info($userEmail);
		$email = array('custserv@futurestarr.com', 'futurestarr2012@yahoo.com',$userEmail);
		$data['pathToImage'] = public_path() . "/assets/images/futurelogo.png";
		Mail::send('email-templates.seller-register', $data, function ($message) use ($email) {
			$message->from("custserv@futurestarr.com");
			$message->to($email[2]);
			$message->subject("Welcome to FutureStarr");
		});

		// check for failures
		if (Mail::failures()) {
			return false;
		}
		Log::info("success");
	}

	public function newTalentEmailToBuyer($productLinks,$buyer) {

			Log::info("method called");
			Log::info($buyer['email']);
			$email = array('custserv@futurestarr.com', 'futurestarr2012@yahoo.com',$buyer['email']);
			$data['pathToImage'] = public_path() . "/assets/images/futurelogo.png";
			$data['productLinks'] = $productLinks;
			$data['username'] = $buyer['username'];
			$data['email'] = $buyer['email'];
			Mail::send('email-templates.talent-mail-to-buyer', $data, function ($message) use ($email) {
				$message->from("custserv@futurestarr.com");
				$message->to($email[2]);
				$message->subject("Welcome to FutureStarr");
			});

			// check for failures
			if (Mail::failures()) {
				return false;
			}
			Log::info("success");
		}

	public function triggerMessageEmail($message = array()) {

			Log::info("method called");
			$email = $message['to'];
			$data['pathToImage'] = public_path() . "/assets/images/futurelogo.png";
			
			$data['content'] = $message['content']; 
            $data['from'] = $message['from'];
            $data['name'] = $message['to_name'];
            $data['from_name'] = $message['from_name'];
 
			Mail::send('email-templates.message-template', $data, function ($message) use ($email) {
				$message->from("custserv@futurestarr.com");
				$message->to($email);
				$message->subject("Welcome to FutureStarr");
			});
			// check for failures
			if (Mail::failures()) {
				return false;
			}
			Log::info("success");
	} 

	public function sendChatMessageNotification($message = array()) {

        Log::info("method called");
     
		$email = $message['email'];
		$data['pathToImage'] = public_path() . "/assets/images/futurelogo.png";
		$data['content'] = $message['message']; 
		$data['sender'] = $message['sender'];
		$data['name'] = $message['name'];

		Mail::send('email-templates.chat-message-template', $data, function ($message) use ($email) {
			$message->from("custserv@futurestarr.com");
			$message->to($email);
			$message->subject("Welcome to FutureStarr");
		});
		// check for failures
		if (Mail::failures()) {
			return false;
		} else {
			Log::info("success");
			return true;
		}
			
	}

	public function triggerRiderEmail($message = array()) {

		Log::info("method called");
		$email = $message['email'];
		$data['pathToImage'] = public_path() . "/assets/images/futurelogo.png";
		
		$data['content'] = $message['content']; 
        // $data['from'] = $message['from'];
        $data['name'] = $message['name'];
        $data['sender'] = $message['sender'];

		Mail::send('email-templates.rider-template', $data, function ($message) use ($email) {
			$message->from("custserv@futurestarr.com");
			$message->to($email);
			$message->subject("Welcome to FutureStarr");
		});
		// check for failures
		if (Mail::failures()) {
			return false;
		}
		Log::info("success");
	}

	public function customPlanMail($message = array()) {

		Log::info("method called");
		$email = 'custserv@futurestarr.com';
		$data['pathToImage'] = public_path() . "/assets/images/futurelogo.png";
		
		$data['content'] = $message['content'];

		Mail::send('email-templates.custom-plan', $data, function ($message) use ($email) {
			$message->from("custserv@futurestarr.com");
			$message->to($email);
			$message->subject("Welcome to FutureStarr");
		});
		// check for failures
		if (Mail::failures()) {
			return false;
		}
		Log::info("success");
	}
}

?>
