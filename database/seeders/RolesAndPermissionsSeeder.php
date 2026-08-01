<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        if (Permission::where('name', 'permissions')->first() == null) {
            Permission::create(['name' => 'permissions', 'type' => 1]);
            Permission::create(['name' => 'add-permissions']);
            Permission::create(['name' => 'edit-permissions']);
            Permission::create(['name' => 'delete-permissions']);
            Permission::create(['name' => 'view-permissions']);
            Permission::create(['name' => 'publish-permissions']);
        }

        if (Permission::where('name', 'roles')->first() == null) {
            Permission::create(['name' => 'roles', 'type' => 1]);
            Permission::create(['name' => 'add-roles']);
            Permission::create(['name' => 'edit-roles']);
            Permission::create(['name' => 'delete-roles']);
            Permission::create(['name' => 'view-roles']);
            Permission::create(['name' => 'publish-roles']);
        }

        if (Permission::where('name', 'users')->first() == null) {
            Permission::create(['name' => 'users', 'type' => 1]);
            Permission::create(['name' => 'add-users']);
            Permission::create(['name' => 'edit-users']);
            Permission::create(['name' => 'delete-users']);
            Permission::create(['name' => 'view-users']);
            Permission::create(['name' => 'publish-users']);
        }

        if (Permission::where('name', 'application-setting-types')->first() == null) {
            Permission::create(['name' => 'application-setting-types', 'type' => 1]);
            Permission::create(['name' => 'add-application-setting-types']);
            Permission::create(['name' => 'edit-application-setting-types']);
            Permission::create(['name' => 'delete-application-setting-types']);
            Permission::create(['name' => 'view-application-setting-types']);
            Permission::create(['name' => 'publish-application-setting-types']);
        }

        if (Permission::where('name', 'application-setting-categories')->first() == null) {
            Permission::create(['name' => 'application-setting-categories', 'type' => 1]);
            Permission::create(['name' => 'add-application-setting-categories']);
            Permission::create(['name' => 'edit-application-setting-categories']);
            Permission::create(['name' => 'delete-application-setting-categories']);
            Permission::create(['name' => 'view-application-setting-categories']);
            Permission::create(['name' => 'publish-application-setting-categories']);
        }

        if (Permission::where('name', 'application-settings')->first() == null) {
            Permission::create(['name' => 'application-settings', 'type' => 1]);
            Permission::create(['name' => 'add-application-settings']);
            Permission::create(['name' => 'edit-application-settings']);
            Permission::create(['name' => 'delete-application-settings']);
            Permission::create(['name' => 'view-application-settings']);
            Permission::create(['name' => 'publish-application-settings']);
        }

        if (Permission::where('name', 'slider')->first() == null) {
            Permission::create(['name' => 'slider', 'type' => 1]);
            Permission::create(['name' => 'add-slider']);
            Permission::create(['name' => 'edit-slider']);
            Permission::create(['name' => 'delete-slider']);
            Permission::create(['name' => 'view-slider']);
            Permission::create(['name' => 'publish-slider']);
        }

        if (Permission::where('name', 'cms')->first() == null) {
            Permission::create(['name' => 'cms', 'type' => 1]);
            Permission::create(['name' => 'add-cms']);
            Permission::create(['name' => 'edit-cms']);
            Permission::create(['name' => 'delete-cms']);
            Permission::create(['name' => 'view-cms']);
            Permission::create(['name' => 'publish-cms']);
        }

        if (Permission::where('name', 'service-categories')->first() == null) {
            Permission::create(['name' => 'service-categories', 'type' => 1]);
            Permission::create(['name' => 'add-service-categories']);
            Permission::create(['name' => 'edit-service-categories']);
            Permission::create(['name' => 'delete-service-categories']);
            Permission::create(['name' => 'view-service-categories']);
            Permission::create(['name' => 'publish-service-categories']);
        }

        if (Permission::where('name', 'services')->first() == null) {
            Permission::create(['name' => 'services', 'type' => 1]);
            Permission::create(['name' => 'add-services']);
            Permission::create(['name' => 'edit-services']);
            Permission::create(['name' => 'delete-services']);
            Permission::create(['name' => 'view-services']);
            Permission::create(['name' => 'publish-services']);
        }

        if (Permission::where('name', 'clientele_categories')->first() == null) {
            Permission::create(['name' => 'clientele_categories', 'type' => 1]);
            Permission::create(['name' => 'add-clientele_categories']);
            Permission::create(['name' => 'edit-clientele_categories']);
            Permission::create(['name' => 'delete-clientele_categories']);
            Permission::create(['name' => 'view-clientele_categories']);
            Permission::create(['name' => 'publish-clientele_categories']);
        }

        if (Permission::where('name', 'clienteles')->first() == null) {
            Permission::create(['name' => 'clienteles', 'type' => 1]);
            Permission::create(['name' => 'add-clienteles']);
            Permission::create(['name' => 'edit-clienteles']);
            Permission::create(['name' => 'delete-clienteles']);
            Permission::create(['name' => 'view-clienteles']);
            Permission::create(['name' => 'publish-clienteles']);
        }

        if (Permission::where('name', 'blog_categories')->first() == null) {
            Permission::create(['name' => 'blog_categories', 'type' => 1]);
            Permission::create(['name' => 'add-blog_categories']);
            Permission::create(['name' => 'edit-blog_categories']);
            Permission::create(['name' => 'delete-blog_categories']);
            Permission::create(['name' => 'view-blog_categories']);
            Permission::create(['name' => 'publish-blog_categories']);
        }
        if (Permission::where('name', 'blog_posts')->first() == null) {
            Permission::create(['name' => 'blog_posts', 'type' => 1]);
            Permission::create(['name' => 'add-blog_posts']);
            Permission::create(['name' => 'edit-blog_posts']);
            Permission::create(['name' => 'delete-blog_posts']);
            Permission::create(['name' => 'view-blog_posts']);
            Permission::create(['name' => 'publish-blog_posts']);
        }

        if (Permission::where('name', 'testimonial_categories')->first() == null) {
            Permission::create(['name' => 'testimonial_categories', 'type' => 1]);
            Permission::create(['name' => 'add-testimonial_categories']);
            Permission::create(['name' => 'edit-testimonial_categories']);
            Permission::create(['name' => 'delete-testimonial_categories']);
            Permission::create(['name' => 'view-testimonial_categories']);
            Permission::create(['name' => 'publish-testimonial_categories']);
        }

        if (Permission::where('name', 'testimonials')->first() == null) {
            Permission::create(['name' => 'testimonials', 'type' => 1]);
            Permission::create(['name' => 'add-testimonials']);
            Permission::create(['name' => 'edit-testimonials']);
            Permission::create(['name' => 'delete-testimonials']);
            Permission::create(['name' => 'view-testimonials']);
            Permission::create(['name' => 'publish-testimonials']);
        }

        if (Permission::where('name', 'statistics')->first() == null) {
            Permission::create(['name' => 'statistics', 'type' => 1]);
            Permission::create(['name' => 'add-statistics']);
            Permission::create(['name' => 'edit-statistics']);
            Permission::create(['name' => 'delete-statistics']);
            Permission::create(['name' => 'view-statistics']);
            Permission::create(['name' => 'publish-statistics']);
        }
        if (Permission::where('name', 'product_categories')->first() == null) {
            Permission::create(['name' => 'product_categories', 'type' => 1]);
            Permission::create(['name' => 'add-product_categories']);
            Permission::create(['name' => 'edit-product_categories']);
            Permission::create(['name' => 'delete-product_categories']);
            Permission::create(['name' => 'view-product_categories']);
            Permission::create(['name' => 'publish-product_categories']);
        }
        if (Permission::where('name', 'products')->first() == null) {
            Permission::create(['name' => 'products', 'type' => 1]);
            Permission::create(['name' => 'add-products']);
            Permission::create(['name' => 'edit-products']);
            Permission::create(['name' => 'delete-products']);
            Permission::create(['name' => 'view-products']);
            Permission::create(['name' => 'publish-products']);
        }

        if (Permission::where('name', 'team_categories')->first() == null) {
            Permission::create(['name' => 'team_categories', 'type' => 1]);
            Permission::create(['name' => 'add-team_categories']);
            Permission::create(['name' => 'edit-team_categories']);
            Permission::create(['name' => 'delete-team_categories']);
            Permission::create(['name' => 'view-team_categories']);
            Permission::create(['name' => 'publish-team_categories']);
        }

        if (Permission::where('name', 'teams')->first() == null) {
            Permission::create(['name' => 'teams', 'type' => 1]);
            Permission::create(['name' => 'add-teams']);
            Permission::create(['name' => 'edit-teams']);
            Permission::create(['name' => 'delete-teams']);
            Permission::create(['name' => 'view-teams']);
            Permission::create(['name' => 'publish-teams']);
        }

        if (Permission::where('name', 'faq_categories')->first() == null) {
            Permission::create(['name' => 'faq_categories', 'type' => 1]);
            Permission::create(['name' => 'add-faq_categories']);
            Permission::create(['name' => 'edit-faq_categories']);
            Permission::create(['name' => 'delete-faq_categories']);
            Permission::create(['name' => 'view-faq_categories']);
            Permission::create(['name' => 'publish-faq_categories']);
        }

        if (Permission::where('name', 'faqs')->first() == null) {
            Permission::create(['name' => 'faqs', 'type' => 1]);
            Permission::create(['name' => 'add-faqs']);
            Permission::create(['name' => 'edit-faqs']);
            Permission::create(['name' => 'delete-faqs']);
            Permission::create(['name' => 'view-faqs']);
            Permission::create(['name' => 'publish-faqs']);
        }

        if (Permission::where('name', 'link_categories')->first() == null) {
            Permission::create(['name' => 'link_categories', 'type' => 1]);
            Permission::create(['name' => 'add-link_categories']);
            Permission::create(['name' => 'edit-link_categories']);
            Permission::create(['name' => 'delete-link_categories']);
            Permission::create(['name' => 'view-link_categories']);
            Permission::create(['name' => 'publish-link_categories']);
        }

        if (Permission::where('name', 'links')->first() == null) {
            Permission::create(['name' => 'links', 'type' => 1]);
            Permission::create(['name' => 'add-links']);
            Permission::create(['name' => 'edit-links']);
            Permission::create(['name' => 'delete-links']);
            Permission::create(['name' => 'view-links']);
            Permission::create(['name' => 'publish-links']);
        }

        if (Permission::where('name', 'sub_links')->first() == null) {
            Permission::create(['name' => 'sub_links', 'type' => 1]);
            Permission::create(['name' => 'add-sub_links']);
            Permission::create(['name' => 'edit-sub_links']);
            Permission::create(['name' => 'delete-sub_links']);
            Permission::create(['name' => 'view-sub_links']);
            Permission::create(['name' => 'publish-sub_links']);
        }

        if (Permission::where('name', 'service-types')->first() == null) {
            Permission::create(['name' => 'service-types', 'type' => 1]);
            Permission::create(['name' => 'add-service-types']);
            Permission::create(['name' => 'edit-service-types']);
            Permission::create(['name' => 'delete-service-types']);
            Permission::create(['name' => 'view-service-types']);
            Permission::create(['name' => 'publish-service-types']);
        }

        if (Permission::where('name', 'news')->first() == null) {
            Permission::create(['name' => 'news', 'type' => 1]);
            Permission::create(['name' => 'add-news']);
            Permission::create(['name' => 'edit-news']);
            Permission::create(['name' => 'delete-news']);
            Permission::create(['name' => 'view-news']);
            Permission::create(['name' => 'publish-news']);
        }

        if (Permission::where('name', 'photo-gallery-categories')->first() == null) {
            Permission::create(['name' => 'photo-gallery-categories', 'type' => 1]);
            Permission::create(['name' => 'add-photo-gallery-categories']);
            Permission::create(['name' => 'edit-photo-gallery-categories']);
            Permission::create(['name' => 'delete-photo-gallery-categories']);
            Permission::create(['name' => 'view-photo-gallery-categories']);
            Permission::create(['name' => 'publish-photo-gallery-categories']);
        }

        if (Permission::where('name', 'photo-galleries')->first() == null) {
            Permission::create(['name' => 'photo-galleries', 'type' => 1]);
            Permission::create(['name' => 'add-photo-galleries']);
            Permission::create(['name' => 'edit-photo-galleries']);
            Permission::create(['name' => 'delete-photo-galleries']);
            Permission::create(['name' => 'view-photo-galleries']);
            Permission::create(['name' => 'publish-photo-galleries']);
        }

        if (Permission::where('name', 'payment-methods')->first() == null) {
            Permission::create(['name' => 'payment-methods', 'type' => 1]);
            Permission::create(['name' => 'add-payment-methods']);
            Permission::create(['name' => 'edit-payment-methods']);
            Permission::create(['name' => 'delete-payment-methods']);
            Permission::create(['name' => 'view-payment-methods']);
            Permission::create(['name' => 'publish-payment-methods']);
        }

        if (Permission::where('name', 'customers')->first() == null) {
            Permission::create(['name' => 'customers', 'type' => 1]);
            Permission::create(['name' => 'add-customers']);
            Permission::create(['name' => 'edit-customers']);
            Permission::create(['name' => 'delete-customers']);
            Permission::create(['name' => 'view-customers']);
            Permission::create(['name' => 'publish-customers']);
        }

        if (Permission::where('name', 'coupons')->first() == null) {
            Permission::create(['name' => 'coupons', 'type' => 1]);
            Permission::create(['name' => 'add-coupons']);
            Permission::create(['name' => 'edit-coupons']);
            Permission::create(['name' => 'delete-coupons']);
            Permission::create(['name' => 'view-coupons']);
            Permission::create(['name' => 'publish-coupons']);
        }

        if (Permission::where('name', 'orders')->first() == null) {
            Permission::create(['name' => 'orders', 'type' => 1]);
            Permission::create(['name' => 'add-orders']);
            Permission::create(['name' => 'edit-orders']);
            Permission::create(['name' => 'delete-orders']);
            Permission::create(['name' => 'view-orders']);
            Permission::create(['name' => 'publish-orders']);
        }

        if (Permission::where('name', 'event-categories')->first() == null) {
            Permission::create(['name' => 'event-categories', 'type' => 1]);
            Permission::create(['name' => 'add-event-categories']);
            Permission::create(['name' => 'edit-event-categories']);
            Permission::create(['name' => 'delete-event-categories']);
            Permission::create(['name' => 'view-event-categories']);
            Permission::create(['name' => 'publish-event-categories']);
        }

        if (Permission::where('name', 'events')->first() == null) {
            Permission::create(['name' => 'events', 'type' => 1]);
            Permission::create(['name' => 'add-events']);
            Permission::create(['name' => 'edit-events']);
            Permission::create(['name' => 'delete-events']);
            Permission::create(['name' => 'view-events']);
            Permission::create(['name' => 'publish-events']);
        }

        if (Permission::where('name', 'pujas')->first() == null) {
            Permission::create(['name' => 'pujas', 'type' => 1]);
            Permission::create(['name' => 'add-pujas']);
            Permission::create(['name' => 'edit-pujas']);
            Permission::create(['name' => 'delete-pujas']);
            Permission::create(['name' => 'view-pujas']);
            Permission::create(['name' => 'publish-pujas']);
        }

        if (Permission::where('name', 'puja-orders')->first() == null) {
            Permission::create(['name' => 'puja-orders', 'type' => 1]);
            Permission::create(['name' => 'add-puja-orders']);
            Permission::create(['name' => 'edit-puja-orders']);
            Permission::create(['name' => 'delete-puja-orders']);
            Permission::create(['name' => 'view-puja-orders']);
            Permission::create(['name' => 'publish-puja-orders']);
        }

        if (Permission::where('name', 'frontend-users')->first() == null) {
            Permission::create(['name' => 'frontend-users', 'type' => 1]);
            Permission::create(['name' => 'add-frontend-users']);
            Permission::create(['name' => 'edit-frontend-users']);
            Permission::create(['name' => 'delete-frontend-users']);
            Permission::create(['name' => 'view-frontend-users']);
            Permission::create(['name' => 'publish-frontend-users']);
        }

        if (Permission::where('name', 'halls')->first() == null) {
            Permission::create(['name' => 'halls', 'type' => 1]);
            Permission::create(['name' => 'add-halls']);
            Permission::create(['name' => 'edit-halls']);
            Permission::create(['name' => 'delete-halls']);
            Permission::create(['name' => 'view-halls']);
            Permission::create(['name' => 'publish-halls']);
        }

        if (Permission::where('name', 'hall-addons')->first() == null) {
            Permission::create(['name' => 'hall-addons', 'type' => 1]);
            Permission::create(['name' => 'add-hall-addons']);
            Permission::create(['name' => 'edit-hall-addons']);
            Permission::create(['name' => 'delete-hall-addons']);
            Permission::create(['name' => 'view-hall-addons']);
            Permission::create(['name' => 'publish-hall-addons']);
        }

        if (Permission::where('name', 'hall-event-types')->first() == null) {
            Permission::create(['name' => 'hall-event-types', 'type' => 1]);
            Permission::create(['name' => 'add-hall-event-types']);
            Permission::create(['name' => 'edit-hall-event-types']);
            Permission::create(['name' => 'delete-hall-event-types']);
            Permission::create(['name' => 'view-hall-event-types']);
            Permission::create(['name' => 'publish-hall-event-types']);
        }

        if (Permission::where('name', 'hall-orders')->first() == null) {
            Permission::create(['name' => 'hall-orders', 'type' => 1]);
            Permission::create(['name' => 'add-hall-orders']);
            Permission::create(['name' => 'edit-hall-orders']);
            Permission::create(['name' => 'delete-hall-orders']);
            Permission::create(['name' => 'view-hall-orders']);
            Permission::create(['name' => 'publish-hall-orders']);
        }

        if (Permission::where('name', 'temple-tours')->first() == null) {
            Permission::create(['name' => 'temple-tours', 'type' => 1]);
            Permission::create(['name' => 'add-temple-tours']);
            Permission::create(['name' => 'edit-temple-tours']);
            Permission::create(['name' => 'delete-temple-tours']);
            Permission::create(['name' => 'view-temple-tours']);
            Permission::create(['name' => 'publish-temple-tours']);
        }

        if (Permission::where('name', 'activity-log')->first() == null) {
            Permission::create(['name' => 'activity-log', 'type' => 1]);
            Permission::create(['name' => 'add-activity-log']);
            Permission::create(['name' => 'edit-activity-log']);
            Permission::create(['name' => 'delete-activity-log']);
            Permission::create(['name' => 'view-activity-log']);
            Permission::create(['name' => 'publish-activity-log']);
        }

        // create roles and assign created permissions
        if (Role::where('name', 'Developer Admin')->first() == null) {
            $role = Role::create(['name' => 'Developer Admin']);
            $role->givePermissionTo(Permission::all());
        } else {
            $role = Role::where('name', 'Developer Admin')->first();
            $role->givePermissionTo(Permission::all());
        }
    }
}
