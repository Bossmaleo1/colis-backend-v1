<?php
        // Enabling error reporting
        error_reporting(-1);
        ini_set('display_errors', 'On');
        //L'api fcm
        /*
          1.message
          2.title
          3.push_type
          4.regId
        */
        
        /*$_GET['message']="Salut mon gar, comment vas tu ? moi je vais bien";
        $_GET['title']="Wazaby";
        $_GET['push_type']="individual";
        $_GET['regId']="fiBsKKfkO50:APA91bF4sG0Le6yD2KBGbpeHXaSYWf268EtqJwovShMHNhiBKydHCgP0jG-i8UQgZ5Rt_zWwP9KqUVxs0q3aSkk1vvjmRIrR6s00PN0FRkt7IGg4JDX9MHU4wsxSvCfZ28ltMHyRl0VF";*/

        require_once __DIR__ . '/firebase.php';
        require_once __DIR__ . '/push.php';

        $firebase = new Firebase();
        $push = new Push();

        // optional payload
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';

        // notification title
        $title = isset($_GET['title']) ? $_GET['title'] : '';

        // notification message
        $message = isset($_GET['message']) ? $_GET['message'] : '';

        // push type - single user / topic
        $push_type = isset($_GET['push_type']) ? $_GET['push_type'] : '';

        // whether to include to image or not
        $include_image = isset($_GET['include_image']) ? TRUE : FALSE;


        $push->setTitle($title);
        $push->setMessage($message);
        if ($include_image) {
            $push->setImage('http://api.androidhive.info/images/minion.jpg');
        } else {
            $push->setImage('');
        }
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);


        $json = '';
        $response = '';

        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            $regId = isset($_GET['regId']) ? $_GET['regId'] : '';
			$res = array();
			$res['title'] = $_GET['title'];
			$res['body'] = $_GET['message'];
            $response = $firebase->send($regId,$res);
        }
        ?>
