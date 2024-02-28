<?php

return
    [

        /**
         --------------------------------------------------------------------------
          ENABLE/DISABLE MIGRATIONS
         --------------------------------------------------------------------------
         *
         * Migrations are enabled by default.
         * 
         * You should enable migrations whenever you intend to do a schema migration
         * and disable it back when you're done.
         * @var bool
         */
        'enabled' => true,

        /**
         --------------------------------------------------------------------------
          MIGRATIONS TABLE
         --------------------------------------------------------------------------
         *
         * This defines the name of the table used to store migration information.
         * @var string        
         */
        'table' => 'migrations',

        /**
         --------------------------------------------------------------------------
          TIMESTAMP FORMAT
         --------------------------------------------------------------------------
         *
         * This is the format that will be used when creating new migrations
         * using the CLI command:
         *   > php axm make:migrate
         *
         * Typical formats:
         * - YmdHis_
         * - Y-m-d-His_
         * - Y_m_d_His_
         * @var string
         */
        'timestampFormat' => 'Y-m-d-His_',
    ];
