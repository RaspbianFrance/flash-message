<?php
    namespace FlashMessage;

	/**
     * Allow writing and reading flash messages from session.
	 */

    class FlashMessage
    {
        /**
         * Write a message in session
         * @param string $type : Type of the message (usually success, error, info or danger)
         * @param string $text : Text of the message
         */
        public static function push ($type, $text)
        {
            if (session_status() !== PHP_SESSION_ACTIVE)
            {
                return false;
            }

            if (empty($_SESSION['flash_messages']))
            {
                $_SESSION['flash_messages'] = [];
            }

            $_SESSION['flash_messages'][] = [
                'type' => $type,
                'text' => $text,
            ];
        }

        /**
         * Get the next message
         * @return mixed array|bool : If there is a next message, return it, else return false
         */
        public static function next ()
        {
            if (session_status() !== PHP_SESSION_ACTIVE)
            {
                return false;
            }

            if (empty($_SESSION['flash_messages']))
            {
                return false;
            }

            $message = $_SESSION['flash_messages'][0];
            unset($_SESSION['flash_messages'][0]);
            $_SESSION['flash_messages'] = array_values($_SESSION['flash_messages']);

            return $message;
        }

        /**
         * Get a next message of a specific type
         * @param string $type : The type of message we want
         * @return mixed array|bool : If there is a next message of the desired type, return it, else return false
         */
        public static function next_type ($type)
        {
            if (session_status() !== PHP_SESSION_ACTIVE)
            {
                return false;
            }

            if (empty($_SESSION['flash_messages']))
            {
                return false;
            }

            foreach ($_SESSION['flash_messages'] as $key => $message)
            {
                if ($message['type'] !== $type)
                {
                    continue;
                }

                unset($_SESSION['flash_messages'][$key]);
                $_SESSION['flash_messages'] = array_values($_SESSION['flash_messages']);
                return $message;
            }

            return false;
        }

        /**
         * Count messages steel to be displayed
         * @return int : Number of message to display
         */
        public static function count ()
        {
            if (session_status() !== PHP_SESSION_ACTIVE)
            {
                return false;
            }
            
            return count($_SESSION['flash_messages'] ?? []);
        }
	}

