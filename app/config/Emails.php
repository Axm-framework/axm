<?php

/**
 * SMTP Configuration for Sending Emails
 */
return
    [

        /**
         --------------------------------------------------------------------------
          HOST
         --------------------------------------------------------------------------
         *
         * SMTP Server Hostname or IP Address
         * @var string
         */
        'host' => 'mail.axiomatransfer.com',

        /**
         --------------------------------------------------------------------------
          PORT
         --------------------------------------------------------------------------
         *
         * SMTP Server Port
         * Specify the port number of your SMTP server.
         * Example: 587 (for TLS), 465 (for SSL)
         * @var int
         */
        'port' => 465,

        /**
         --------------------------------------------------------------------------
          SMTP AUTH
         --------------------------------------------------------------------------
         *
         * SMTP Authentication
         * Set this to 'true' if your SMTP server requires authentication,
         * otherwise set it to 'false'.
         */
        'SMTPAuth' => true,

        /**
         --------------------------------------------------------------------------
          NAME
         --------------------------------------------------------------------------
         *
         * Sender Name
         * Specify the name that will appear as the sender of the email.
         * @var string
         */
        'name' => 'Your Name',

        /**
         --------------------------------------------------------------------------
          USERNAME
         --------------------------------------------------------------------------
         *
         * SMTP Username
         * Specify the username for SMTP authentication (if required).
         * @var string
         */
        'username' => 'your_username@example.com',

        /**
         --------------------------------------------------------------------------
          PASSWORD
         --------------------------------------------------------------------------
         *
         * SMTP Password
         * Specify the password for SMTP authentication (if required).
         * @var string
         */
        'password' => 'your_password',

        /**
         --------------------------------------------------------------------------
          SMTP SECURE
         --------------------------------------------------------------------------
         *
         * SMTP Secure Connection
         * Choose the type of secure connection to use with SMTP.
         * Possible values: 'tls', 'ssl', or null (for no secure connection).
         * @var string|null
         */
        'SMTPSecure' => 'ssl',

        /**
         --------------------------------------------------------------------------
          IS HTML
         --------------------------------------------------------------------------
         *
         * Use HTML Emails
         * Set this to 'true' if your emails contain HTML content, otherwise 'false'.
         * @var bool
         */
        'isHTML' => true,
    ];
