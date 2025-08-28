<?php

namespace Database\Seeders;

use App\Models\PaymentSetting;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'id' => 1,
                'key' => 'site_name',
                'value' => 'Hafid Tech Course',
                'created_at' => '2024-10-13 06:07:49',
                'updated_at' => '2024-10-13 06:11:58',
            ],
            [
                'id' => 2,
                'key' => 'default_currency',
                'value' => 'USD',
                'created_at' => '2024-10-13 06:07:49',
                'updated_at' => '2024-10-13 06:11:58',
            ],
            [
                'id' => 3,
                'key' => 'currency_icon',
                'value' => '$',
                'created_at' => '2024-10-13 06:07:49',
                'updated_at' => '2024-10-13 06:11:58',
            ],
            [
                'id' => 4,
                'key' => 'phone',
                'value' => '+1 (228) 498-7767',
                'created_at' => '2024-10-13 06:09:47',
                'updated_at' => '2024-10-13 06:10:06',
            ],
            [
                'id' => 5,
                'key' => 'location',
                'value' => 'Sint nostrud laboru',
                'created_at' => '2024-10-13 06:10:06',
                'updated_at' => '2024-10-13 06:10:06',
            ],
            [
                'id' => 6,
                'key' => 'commission_rate',
                'value' => '70',
                'created_at' => '2024-10-13 09:43:53',
                'updated_at' => '2024-10-13 09:43:53',
            ],
            [
                'id' => 7,
                'key' => 'receiver_email',
                'value' => 'admin.support@gmail.com',
                'created_at' => '2024-10-31 04:35:32',
                'updated_at' => '2024-10-31 04:35:32',
            ],
            [
                'id' => 8,
                'key' => 'sender_email',
                'value' => 'admin@gmail.com',
                'created_at' => '2024-10-31 04:35:32',
                'updated_at' => '2024-10-31 04:35:32',
            ],
            [
                'id' => 9,
                'key' => 'site_logo',
                'value' => '/uploads/educore_67308e7910a41.png',
                'created_at' => '2024-11-10 09:50:10',
                'updated_at' => '2024-11-10 10:44:09',
            ],
            [
                'id' => 10,
                'key' => 'site_footer_logo',
                'value' => '/uploads/educore_67308e7912400.png',
                'created_at' => '2024-11-10 09:50:10',
                'updated_at' => '2024-11-10 10:44:09',
            ],
            [
                'id' => 11,
                'key' => 'site_favicon',
                'value' => '/uploads/educore_67308e7912837.png',
                'created_at' => '2024-11-10 09:50:10',
                'updated_at' => '2024-11-10 10:44:09',
            ],
            [
                'id' => 12,
                'key' => 'site_breadcrumb',
                'value' => '/uploads/educore_67308e7912c27.jpg',
                'created_at' => '2024-11-10 09:50:10',
                'updated_at' => '2024-11-10 10:44:09',
            ],
            [
                'id' => 13,
                'key' => 'mail_mailer',
                'value' => 'smtp',
                'created_at' => '2024-11-10 11:50:17',
                'updated_at' => '2024-11-10 11:50:49',
            ],
            [
                'id' => 14,
                'key' => 'mail_host',
                'value' => 'sandbox.smtp.mailtrap.io',
                'created_at' => '2024-11-10 11:50:17',
                'updated_at' => '2024-11-10 11:50:49',
            ],
            [
                'id' => 15,
                'key' => 'mail_port',
                'value' => '2525',
                'created_at' => '2024-11-10 11:50:17',
                'updated_at' => '2024-11-10 11:50:49',
            ],
            [
                'id' => 16,
                'key' => 'mail_username',
                'value' => '64873daf495440',
                'created_at' => '2024-11-10 11:50:17',
                'updated_at' => '2024-11-10 11:50:49',
            ],
            [
                'id' => 17,
                'key' => 'mail_password',
                'value' => 'ad63d0846ee854',
                'created_at' => '2024-11-10 11:50:17',
                'updated_at' => '2024-11-10 11:50:49',
            ],
            [
                'id' => 18,
                'key' => 'mail_encryption',
                'value' => 'tls',
                'created_at' => '2024-11-10 11:50:17',
                'updated_at' => '2024-11-10 11:50:49',
            ],
            [
                'id' => 19,
                'key' => 'mail_queue',
                'value' => '1',
                'created_at' => '2024-11-10 11:50:17',
                'updated_at' => '2024-11-10 11:50:17',
            ],
        ];

        $payment_settings = [
            [
                'id' => 1,
                'key' => 'paypal_mode',
                'value' => 'sandbox',
                'created_at' => '2024-10-09 07:07:45',
                'updated_at' => '2024-10-09 09:49:14',
            ],
            [
                'id' => 2,
                'key' => 'paypal_client_id',
                'value' => 'AWPDtCm44vXv5NDEavf4026oMpPS1tlOSMfIF-NRqbgE9WKTXFcvAyn9DHb2Y-AMdsj2WckhSuKPqTY2',
                'created_at' => '2024-10-09 07:07:45',
                'updated_at' => '2024-10-09 09:49:08',
            ],
            [
                'id' => 3,
                'key' => 'paypal_client_secret',
                'value' => 'EKkvn-FnfwoszpgcImTjxxo-Apd-2UNbxRbivkf2HcoIa4ZJv24_lywlaNRJmiPD4LQEd05mWsBIrdS6',
                'created_at' => '2024-10-09 07:07:45',
                'updated_at' => '2024-10-09 09:49:08',
            ],
            [
                'id' => 4,
                'key' => 'paypal_currency',
                'value' => 'USD',
                'created_at' => '2024-10-09 07:07:45',
                'updated_at' => '2024-10-09 09:48:23',
            ],
            [
                'id' => 5,
                'key' => 'paypal_rate',
                'value' => '1',
                'created_at' => '2024-10-09 07:07:45',
                'updated_at' => '2024-10-09 09:47:56',
            ],
            [
                'id' => 6,
                'key' => 'paypal_app_id',
                'value' => 'sb-sqjju41840836_api1.business.example.com',
                'created_at' => '2024-10-09 07:07:45',
                'updated_at' => '2024-10-09 09:49:08',
            ],
        ];

        Setting::insert($settings);
        PaymentSetting::insert($payment_settings);
    }
}
