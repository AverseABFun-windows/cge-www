=== Plugin Name ===
Contributors: wordpressorg@patreon.com, codebard
Tags: patreon, membership, members
Requires at least: 4.0
Tested up to: 4.9.1
Stable tag: 1.0.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Serve patron-only posts - directly on your WordPress website.

== Description ==

When a patron pledges, they can then head over to www.yourwordpresssite.com and click your “Unlock with Patreon” button to let the site know they are a patron. When you create content on WordPress you will be given the option to limit it to only paying patrons.

This plugin is maintained by Patreon. For advanced features, you can find additional premium WordPress plugins in this directory.

Read an in-depth review of this free plugin and how to <a href="https://www.elegantthemes.com/blog/tips-tricks/how-to-create-a-patreon-membership-site-on-wordpress" target="_blank">combine Patreon and WordPress part of your membership business</a> on Elegant Themes

### FEATURES FOR CREATORS

- Choose a minimum pledge amount necessary to see a particular post
- Alternatively, set a minimum pledge amount to see all posts.
- Set custom HTML that non-patrons see instead of the post, prompting them to become a patron

*<b>You can post entirely independently on your WordPress site from your Patreon page.*</b> There is no need for WordPress and Patreon posts to correspond to one another in content or in locked status. The choice is up to you as a creator.

Got ideas? Suggest them to the developer community on our <a href="https://www.patreondevelopers.com/t/wordpress-plugin-feature-ideas/215">Patreon WordPress Ideas Thread</a>

### FEATURES FOR PATRONS

- This plugin adds a “Unlock with Patreon” button to every locked post.
- “Unlock with Patreon” takes care of everything: whether they’re not yet a patron, need to upgrade their pledge, or already pledging enough, we’ll guide them through the process and back to your content

### FEATURES FOR DEVELOPERS

- Extend this free basic WordPress plugin with your own inter-operable plugins that install side by side.
- Rapidly develop patron-only WordPress features without initial overhead
- Immediately usable by existing Patreon creators running this plugin

Learn more in our [developer portal](https://www.patreon.com/portal).

### PRICING

This plugin is provided by Patreon for free.

== Installation ==

## Install the Patreon WordPress Plugin

1. Install & activate the plugin
2. Click on ‘Patreon Settings’ to view the options page. It will look something like the below, copy the ‘Redirect URI‘ into the clip board and keep for the next step.
![](https://c5.patreon.com/external/platform/wordpress-client.png)
3. This plugin requires that you enable "pretty permalinks." (ie /page-name/ as opposed to ?pid=36). You can do this from the WordPress admin interface, visit Settings > Permalinks and choose any format aside from "Plain."

## Generate API Credentials on Patreon.com

1. Ensure you are logged into Patreon, using your creator account. When it comes to testing this out you will want to have two Patreon accounts, one that acts as a patron and one being the content creator. The OAuth client needs to be created on your content creating account.
2. Visit the [oAuth client page here](https://www.patreon.com/portal/registration/register-clients) and click "Create Client", fill out the form and add in an image URL for the icon that will appear to users when they are connecting to your website.
3. Note the field for ‘Redirect URI‘, this should still be in your clipboard from the previous steps – if not copy/paste it exactly as it appears on the WordPress admin Patreon Settings page.
4. Click the ‘Create Client’ button, and you should now see the new client in the list.
5. Click the downward facing caret on the right side to expose additional information about the client
6. You should see something like this
![](https://c5.patreon.com/external/platform/wordpress-install-ss5.png)
(The keys in the image are fake, doctored for this screenshot.)

## Paste Your Credentials into WordPress

1. Copy and paste the Client ID and Client Secret from this page into the matching fields on the ‘Patreon Settings’ page.
2. Copy the Client ID, Client Secret, Access Token, and Refresh Token from the top of this page into the WordPress admin Patreon Settings page.
3. Hit ‘Update Settings’ at the bottom of the page.
4. IMPORTANT FINAL STEP: In your WordPress admin ‘Settings’ -> ‘Permalinks’ section, click ‘Save’. This ensures your rewrite rules are flushed.

You should now be up and running with the Patreon WordPress plugin!

## Protecting Posts

When editing a post (or a custom post type) you will see a meta box in the right column titled ‘Patreon Level’.

This box contains a text field that lets you specify a minimum contribution level in dollars. This could be $1 or $1.40 or even $10000. This is entirely up to you.

![](https://c5.patreon.com/external/platform/wordpress_protecting_posts_pages.png)

It defaults to $0 even if left empty.

## Protecting Videos

It is  difficult to protect videos due the intensive bandwidth requirements of hosting video  and having to rely on third parties such as Youtube or Vimeo. Youtube allows you to set videos to ‘private’ but Vimeo offers extra controls by only allowing videos to be played on specific domains. Visit this guide to [protecting your video content with Vimeo](https://help.vimeo.com/hc/en-us/articles/224817847-Privacy-settings-overview).


== Changelog ==

= 1.0.3 =

* Fix for Login with Patreon button not appearing in login page
* Login with Patreon button uses new images

= 1.0.2 =
* Page protection added
* New logic to make cacheable unlock links
* New logic to make cacheable login links
* Login button shortcode added
* State var urlencoded when going to Patreon and urlencoded when back
* Button width fix
* Login button now appears in login form
* User creation logic now uses Patreon-supplied names for WP display name/
* Support link updated in plugin admin

= 1.0.1 =
* API endpoint protocol fix - http to https
* Added !important to button width and height to prevent themes from overriding them

= 1.0 =
* Plugin launched.
