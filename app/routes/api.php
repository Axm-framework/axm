<?php

use Http\Router as Route;

/**
---------------------------------------------------------------
 API ROUTES
---------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider and all of them will
 * be assigned to the "api" middleware group. Make something great!
 * 
 * 
 * 
 *  +------------+---------------------------------------------+-------------------------------+
 *  | Type       | Description                                 | Regular Expression            |
 *  +----------- +---------------------------------------------+-------------------------------+
 *  | Numbers -- | Matchea integers                            | {id:\d+}                      |
 *  | ---------- | Numbers with or without values (opt.)       | {id:\d*}                      |
 *  | ---------- | Numbers with decimal point                  | {price:[\d.]+}                |
 *  | ---------- | Matchea integers                            | {integer:[+-]?\d+}            |
 *  +----------- +---------------------------------------------+-------------------------------+
 *  | Text ----- | Any text, allows spaces                     | {name}                        |
 *  | ---------- | Text with hyphens without spaces            | {slug:[a-zA-Z-]+}             |
 *  | ---------- | Alphanumeric text                           | {alphanumeric:\w+}            |
 *  +----------- +---------------------------------------------+-------------------------------+
 *  | Dates ---- | Format (AAAA-MM-DD)                         | {date:\d{4}-\d{2}-\d{2}}      |
 *  +------------+---------------------------------------------+-------------------------------+-------------------------------+
 *  | Time ----- | 12-hour format with AM/PM                   | {time_12h:(0[1-9]|1[0-2]):[0-5][0-9]:[0-5][0-9] (AM|PM)}      |
 *  +------------+---------------------------------------------+-------------------------------+-------------------------------+
 *  | Booleans-- | 0 o 1                                       | {active:0|1}                  |
 *  | ---------- | true o false                                | {published:true|false}        |
 *  +----------- +---------------------------------------------+-------------------------------+-------------------------------+
 *  | Utilies -- | E-mail address                              | {email:[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}}        |
 *  | ---------- | URL                                         | {url:https?://[^\s/$.?#].[^\s]*}                              |
 *  | ---------- | Zip code  (US)                              | {postal_code:[0-9]{5}}                                        |
 *  | ---------- | Telephone Numbers (US)                      | {phone_number:\(\d{3}\) \d{3}-\d{4}}                          |
 *  | ---------- | Hexadecimal color labels                    | {color_hex:#[a-fA-F0-9]{6}}                                   |
 *  | ---------- | Color RGB                                   | {rgb_color:rgb\(\s?\d{1,3}\s?,\s?\d{1,3}\s?,\s?\d{1,3}\s?\)}  |
 *  | ---------- | United States Social Security Number (SSN)  | {ssn:\d{3}-\d{2}-\d{4}}                                       |
 *  +----------- +---------------------------------------------+-------------------------------+-------------------------------+
 *  | Others --- | MD5 hash                                    | {hash:[0-9a-f]{64}}           |
 *  | ---------- | Files with extension                        | {filename:\w+\.\w+}           |
 *  | ---------- | Any value with 1 or more characters         | {item:.+}                     |
 *  +------------+---------------------------------------------+-------------------------------+
 *
 */

// Route::get('/api/{username}', function ($username) {
//     return app()->response->toJson(['username' => $username]);
// });

// Route::get('/api/{id:\d+}/{country:\w+}', function ($id, $country) {

//     return app()->response->toJson(['id' => $id, 'country' => $country]);
// });

