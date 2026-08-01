<?php
namespace Database\Seeders;
use App\Models\ApplicationSettingType;
use Illuminate\Database\Seeder;
class ApplicationSettingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (ApplicationSettingType::where('slug', 'theme-settings')->first() == null) {
            ApplicationSettingType::create([
                'type' => 'Theme Settings',
                'slug' => 'theme-settings',
            ]);
        }
        if (ApplicationSettingType::where('slug', 'meta-settings')->first() == null) {
            ApplicationSettingType::create([
                'type' => 'Meta Settings',
                'slug' => 'meta-settings',
            ]);
        }
        if (ApplicationSettingType::where('slug', 'site-verification')->first() == null) {
            ApplicationSettingType::create([
                'type' => 'Site Verification',
                'slug' => 'site-verification',
            ]);
        }
        if (ApplicationSettingType::where('slug', 'socail-settings')->first() == null) {
            ApplicationSettingType::create([
                'type' => 'Socail Settings',
                'slug' => 'socail-settings',
            ]);
        }
        if (ApplicationSettingType::where('slug', 'home-page-blocks')->first() == null) {
            ApplicationSettingType::create([
                'type' => 'Home Page Blocks',
                'slug' => 'home-page-blocks',
            ]);
        }
        if (ApplicationSettingType::where('slug', 'contact-details')->first() == null) {
            ApplicationSettingType::create([
                'type' => 'Contact Details',
                'slug' => 'contact-details',
            ]);
        }
        if (ApplicationSettingType::where('slug', 'template-settings')->first() == null) {
            ApplicationSettingType::create([
                'type' => 'Template Settings',
                'slug' => 'template-settings',
            ]);
        }
        if (ApplicationSettingType::where('slug', 'footer')->first() == null) {
            ApplicationSettingType::create([
                'type' => 'Footer',
                'slug' => 'footer',
            ]);
        }
        if (ApplicationSettingType::where('slug', 'payment-settings')->first() == null) {
            ApplicationSettingType::create([
                'type' => 'Payment Settings',
                'slug' => 'payment-settings',
            ]);
        }
        if (ApplicationSettingType::where('slug', 'terms-and-conditions')->first() == null) {
            ApplicationSettingType::create([
                'type' => 'Terms and Conditions',
                'slug' => 'terms-and-conditions',
            ]);
        }
    }
}
