<?php
namespace Database\Seeders;
use App\Models\ApplicationSetting;
use App\Models\ApplicationSettingType;
use Illuminate\Database\Seeder;
class ApplicationSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = ApplicationSettingType::where('slug', 'theme-settings')->first();
        if (ApplicationSetting::where('slug', 'site-name')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Site Name',
                'slug' => 'site-name',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'logo')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Logo',
                'slug' => 'logo',
                'input_type' => 'file',
                'value' => '',
                'application_setting_type_id' => $type->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'favicon')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Favicon',
                'slug' => 'favicon',
                'input_type' => 'file',
                'value' => '',
                'application_setting_type_id' => $type->id
            ]);
        }
        $type1 = ApplicationSettingType::where('slug', 'meta-settings')->first();
        if (ApplicationSetting::where('slug', 'og-title')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Og Title',
                'slug' => 'og-title',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type1->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'og-description')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Og Description',
                'slug' => 'og-description',
                'input_type' => 'textarea-normal',
                'value' => '',
                'application_setting_type_id' => $type1->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'og-type')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Og Type',
                'slug' => 'og-type',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type1->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'og-image')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Og Image',
                'slug' => 'og-image',
                'input_type' => 'file',
                'value' => '',
                'application_setting_type_id' => $type1->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'twitter-title')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Meta Twitter Title',
                'slug' => 'twitter-title',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type1->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'twitter-card')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Twitter Card Content',
                'slug' => 'twitter-card',
                'input_type' => 'textarea-normal',
                'value' => '',
                'application_setting_type_id' => $type1->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'meta-twitter-image')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Meta Twitter Image',
                'slug' => 'meta-twitter-image',
                'input_type' => 'file',
                'value' => '',
                'application_setting_type_id' => $type1->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'fb-app-id')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Fb App Id',
                'slug' => 'fb-app-id',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type1->id
            ]);
        }
        $type2 = ApplicationSettingType::where('slug', 'site-verification')->first();
        if (ApplicationSetting::where('slug', 'google-site-verification-code')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Google Site Verification Code',
                'slug' => 'google-site-verification-code',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type2->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'google-analytics-code')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Google Analytics Code',
                'slug' => 'google-analytics-code',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type2->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'metricool')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Metricool',
                'slug' => 'metricool',
                'input_type' => 'textarea',
                'value' => '',
                'application_setting_type_id' => $type2->id
            ]);
        }
        $type3 = ApplicationSettingType::where('slug', 'socail-settings')->first();
        if (ApplicationSetting::where('slug', 'facebook-url')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Facebook URL',
                'slug' => 'facebook-url',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type3->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'twitter-url')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Twitter URL',
                'slug' => 'twitter-url',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type3->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'instagram-url')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Instagram URL',
                'slug' => 'instagram-url',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type3->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'greview-url')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Goolge Review',
                'slug' => 'greview-url',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type3->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'youtube-url')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Youtube URL',
                'slug' => 'youtube-url',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type3->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'linkedIn-url')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'LinkedIn URL',
                'slug' => 'linkedIn-url',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type3->id
            ]);
        }
        $type4 = ApplicationSettingType::where('slug', 'contact-details')->first();
        if (ApplicationSetting::where('slug', 'primary-phone-number')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Primary Phone Number',
                'slug' => 'primary-phone-number',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type4->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'secondary-phone-number')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Secondary Phone Number',
                'slug' => 'secondary-phone-number',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type4->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'primary-email')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Primary Email',
                'slug' => 'primary-email',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type4->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'secondary-email')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Secondary Email',
                'slug' => 'secondary-email',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type4->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'address')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Address',
                'slug' => 'address',
                'input_type' => 'textarea',
                'value' => '',
                'application_setting_type_id' => $type4->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'location-url')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Location URL',
                'slug' => 'location-url',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type4->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'location-iframe')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Location Iframe',
                'slug' => 'location-iframe',
                'input_type' => 'textarea',
                'value' => '',
                'application_setting_type_id' => $type4->id
            ]);
        }
        $type5 = ApplicationSettingType::where('slug', 'template-settings')->first();
        if (ApplicationSetting::where('slug', 'primay-color')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Primay Color',
                'slug' => 'primay-color',
                'input_type' => 'color',
                'value' => '',
                'application_setting_type_id' => $type5->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'secondary-color')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Secondary Color',
                'slug' => 'secondary-color',
                'input_type' => 'color',
                'value' => '',
                'application_setting_type_id' => $type5->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'tertiary-color')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Tertiary Color',
                'slug' => 'tertiary-color',
                'input_type' => 'color',
                'value' => '',
                'application_setting_type_id' => $type5->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'link-color')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Link Color',
                'slug' => 'link-color',
                'input_type' => 'color',
                'value' => '',
                'application_setting_type_id' => $type5->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'font-color')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Font Color',
                'slug' => 'font-color',
                'input_type' => 'color',
                'value' => '',
                'application_setting_type_id' => $type5->id
            ]);
        }
        $type6 = ApplicationSettingType::where('slug', 'footer')->first();
        if (ApplicationSetting::where('slug', 'temple-timings')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Temple Timings',
                'slug' => 'temple-timings',
                'input_type' => 'textarea',
                'value' => '',
                'application_setting_type_id' => $type6->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'copyright-text')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Copyright Text',
                'slug' => 'copyright-text',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type6->id
            ]);
        }
        $type7 = ApplicationSettingType::where('slug', 'home-page-blocks')->first();
        if (ApplicationSetting::where('slug', 'puja-prayers-link')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Puja & Prayers Link',
                'slug' => 'puja-prayers-link',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type7->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'puja-prayers-link-new-window')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Puja & Prayers Link New Window',
                'slug' => 'puja-prayers-link-new-window',
                'input_type' => 'checkbox',
                'value' => '',
                'application_setting_type_id' => $type7->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'pledge-support-link')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Pledge & Support Link',
                'slug' => 'pledge-support-link',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type7->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'pledge-support-link-new-window')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Pledge & Support Link New Window',
                'slug' => 'pledge-support-link-new-window',
                'input_type' => 'checkbox',
                'value' => '',
                'application_setting_type_id' => $type7->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'whatsapp-scan-image')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Whatsapp Scan Image',
                'slug' => 'whatsapp-scan-image',
                'input_type' => 'file',
                'value' => '',
                'application_setting_type_id' => $type7->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'balvihar-link')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Balvihar Link',
                'slug' => 'balvihar-link',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type7->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'balvihar-link-new-window')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Balvihar Link New Window',
                'slug' => 'balvihar-link-new-window',
                'input_type' => 'checkbox',
                'value' => '',
                'application_setting_type_id' => $type7->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'deepam-link')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Deepam Link',
                'slug' => 'deepam-link',
                'input_type' => 'textbox',
                'value' => '',
                'application_setting_type_id' => $type7->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'deepam-link-new-window')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Deepam Link New Window',
                'slug' => 'deepam-link-new-window',
                'input_type' => 'checkbox',
                'value' => '',
                'application_setting_type_id' => $type7->id
            ]);
        }
        
        $type8 = ApplicationSettingType::where('slug', 'payment-settings')->first();
        if (ApplicationSetting::where('slug', 'payment-mode')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Payment Mode',
                'slug' => 'payment-mode',
                'input_type' => 'select',
                'options' => 'sandbox, live',
                'value' => 'sandbox',
                'application_setting_type_id' => $type8->id
            ]);
        }
        if (ApplicationSetting::where('slug', 'tax')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Tax',
                'slug' => 'tax',
                'input_type' => 'textbox',
                'value' => '5',
                'application_setting_type_id' => $type8->id
            ]);
        }
        if (ApplicationSetting::where('slug', operator: 'currency-symbol')->first() == null) {
            ApplicationSetting::create([
                'field_name' => 'Currency Symbol',
                'slug' => 'currency-symbol',
                'input_type' => 'textbox',
                'value' => '$',
                'application_setting_type_id' => $type8->id
            ]);
        }
    }
}
