=== WPIDE - File Manager & Code Editor ===
Contributors: XplodedThemes
Tags: theme editor, plugin editor, code editor, file editor, file manager, wpide, ide
Requires at least: 5.2
Tested up to: 6.0.1
Stable tag: 3.4.2
Requires PHP: 7.4.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WPIDE is an advanced File Manager & Code Editor for WordPress. You can edit any files in your wp-content folder, not just plugins and themes. Code completion will help you remember your WordPress/PHP commands providing function reference along the way. Edit multiple files with the tabbed editor.

== Description ==

WPIDE is an advanced File Manager & Code Editor for WordPress. You can edit any files in your wp-content folder, not just plugins and themes. Code completion will help you remember your WordPress/PHP commands providing function reference along the way. Edit multiple files with the tabbed editor.

= Video Overview: =

[youtube https://www.youtube.com/watch?v=wF0PUz8wfRM]

<a target="_blank" href="https://www.youtube.com/watch?v=wF0PUz8wfRM">https://www.youtube.com/watch?v=wF0PUz8wfRM</a>


= Features: =

*   File Manager
*   File Tree
*   Customizable Root Path
*   Create new files and directories
*   Download files / folders (Batch support)
*   Upload files / folders using drag n drop (Batch support)
*   Zip / Unzip files and folders (Batch support)
*   Deep search for files / folders by keyword
*   Calculate folder size
*   Advanced File Editor
*   Editor Line numbers
*   Editor Find + Replace
*   Editor Syntax highlighting
*   Editor Highlight Matching Parentheses
*   Editor Automatic Indentation + Code Folding
*   Editor keyboard commands / shortcuts
*   Tabbed interface for editing multiple files
*   WordPress and PHP code auto-completion
*   PHP code parsing and validation
*   PHP file backup before saving
*   File Recovery Wizard
*   Using WordPress filesystem API
*   Beautiful Image Gallery
*   Video / Audio Media Player


<a target="_blank" href="https://wpide.com">👉 **WPIDE PRO**</a>

= Pro Features: =

*   Advanced Image Editor

   -- Resize / Crop Images
   -- Apply filters
   -- Add Frames / Corners
   -- Add Text / Stickers
   -- Add Patterns / Gradients


*   Database Manager

   -- View Tables
   -- Create New Tables
   -- Add / Update / Delete Rows
   -- Update Table Structure
   -- Update Column Indexes
   -- Safe Editing Enabled


== Installation ==

1. Upload the WPide folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Access WPide by clicking the WPide menu item in your main administration menu

== Frequently Asked Questions ==

= What is in place to stop me from breaking my website - "The white screen of death" =

When you edit a PHP file, before that file is saved to the filesystem it is syntax checked to make sure there isn't something obvious that will break your site.

Every file that you edit is backed up before your first save to the filesystem and then on subsequent saves WPIDE will try and make a backup. It will save a maximum of files for up to 5 days to the server.

As you edit or more specifically save PHP files, in case of a fatal error, the File recovery Wizard will appear and a restore button will display which will allow you to restore the most recent backup.

If your WordPress install is fully functional then you can use the file manager to browse all of your backed up files (/upload/wpide/backups/), if your WordPress install isn't responding then restoring the file directly via FTP/SSH is the only way.

The backed up PHP files cannot be accessed/restored from the web directly without the 40 digit nonce/key so should not pose a security concern.

= Can I override the default file permissions when creating files/directories on the local filesystem =

Yes you can using the below WordPress settings in wp-config.php which will effect files created with WPIDE and files added during the WordPress upgrade process.

define('FS_CHMOD_DIR', (0755 & ~ umask()));
define('FS_CHMOD_FILE', (0644 & ~ umask()));

= I get an error notification on the bottom right saying 'something went wrong, unknown error'. How can I fix this ? =

Some hosts might disable direct access to PHP files which will block the plugin from accessing them.

Some users reported this issue on **Cloudways**, and they were able to fix it by enabling **Direct PHP File Access** under application settings within Cloudways dashboard.

This option might be available on other hosting platforms aswell.

== Screenshots ==

1. File Manager
2. Code editor + Auto Complete Reference
3. Image Gallery Viewer
4. Video Player Viewer
5. Files & Folders Deep Search
6. File Recovery Wizard

== Changelog ==

#### 3.4.2 - 05.09.2022
* Support windows server / xampp on windows
* Minor CSS fixes

#### 3.4.1 - 17.08.2022
* Added append content hash when loading js / css chunks to force cache busting making sure always the latest version is used

#### 3.4 - 16.08.2022
* File Editor | Added new Settings tab
* File Editor | Added Scroll Speed option
* File Editor | Added an option to disable Behaviours, such as auto closing tags and brackets
* File Editor | Added option to enable / disable Soft Tabs
* File Editor | Using the enter key within the search input will now take you to the next occurrence
* File Editor | After selecting text then pressing the Ctrl-F key, the search input will focused and populated with the selected text
* File Editor | File Tree | Added file manager action menu for each item.
* File Manager | Added new item actions: Create folder, Create file, Duplicate
* File Manager | The default zip name, which can be changed within the settings, will only be applied when batch zipping or downloading. For a single item, the item name will be used by default instead.
* Minor fixes

#### 3.3 - 02.08.2022
* PHP 8+ Support
* Updated PHP required version to 7.4.0
* To use WPIDE on a lower PHP version, use v2.6 or below.
* Better installation / update handling for the fatal-error-handler.php drop-in to make sure the latest version is always used.

#### 3.2 - 30.07.2022
* Fix corrupt file
* Replace symfony session with transients to avoid session issues with other plugins

#### 3.0 - 30.07.2022
* A brand new and completely revamped version of WPIDE.

#### 2.6 - 26.04.2022
* Plugin acquired by XplodedThemes
* A brand new and completely revamped version of WPide is coming soon, Stay tuned!

#### 2.5 - 2020.04.13
* getting the plugin back to life
* started big code cleanup
* completely removed experimental Git features
* fully compatible with latest WordPress

#### 2.4.0
* Context menu option added to file browser to rename, delete, download, zip, unzip!! thanks to shanept https://github.com/shanept for the code behind this.
  Right click on a folder/file in the file browser to see options (Thanks to https://github.com/shanept)
* find+replace
* Stopped using the full functionality of sanitize_file_name() and using a cut down version instead that allows period, dash and underscore at the beginning and end of filename.
* corrected invalid regex for determining image type
* Changed order of PHP4 compatible constructor in an attempt to stop a PHP Strict Standard error
* Update to Ace Editor 1.2.0
* Editor settings, so that it’s possible to change the theme and other editor features/behaviours
* New application icon in menu bar

#### 2.3.2
* Update the Ace component to 1.1.1 which includes some bug fixes, a PHP worker (showing PHP errors as you work) and a greatly improved search box.
* Fixed issue with file save showing javascript alert as if there was a failure when there wasn't
* Order folders and files alphabetically

#### 2.3.1
* As a quick fix I have commented out the git functionality as the namespacing used is causing issues with old versions of PHP

#### 2.3
* Added initial git functions using the following library: PHP-Stream-Wrapper-for-Git from https://github.com/teqneers/PHP-Stream-Wrapper-for-Git
* Initial Git functionality added - it's very experimental!

#### 2.2
* Add restore recent backup facility - It's a primitive implementation at this point but it does the job. See FAQ note.
* Turned on the LESS mode when a .LESS file is edited
* Made the autocomplete functionality only be enabled for PHP files otherwise it can be a pain to write txt files like this one!

#### 2.1
* Ramped up the version number because the last one was just getting silly
* Interface changes to make the editor take up more screen space. Including hiding the WP admin menu and footer.

#### 2.0.16
* Fixed problem saving PHP documents - PHP-Parser library wasn't included in the codebase correctly

#### 2.0.15
* PHP syntax checking before saving to disk (Using: https://github.com/nikic/PHP-Parser)

#### 2.0.14
* Fixed error Warning: Creating default object from empty value in WPide.php
* Updated the ace editor to current build

#### 2.0.13
* Added colour assist - a colour picker that displays when you double click a hex colour code in the editor (see other notes for info).
* Added a confirm box to stop you exiting the editor by mistake and losing unsaved changes.
* Added 'wpide_filesystem_root' filter (see other notes for info).
* A number of bug fixes.

#### 2.0.12
* Added links to the WordPress codex and the PHP manual from within the function reference for further info

#### 2.0.11
* Newly created files use to contain a space, instead it now defaults to a blank file.

#### 2.0.10
* Fixed a problem with file loading (ajax) indicator not showing.

#### 2.0.9
* Upload snapshot of current ajaxorg editor (master/build/src) at 00:30 on the 22 May 2012. Which fixes some issues with selecting big blocks of text, code folding seems better with gutter interface hidden when not in use

#### 2.0.8
* Fix browser compatibility issues

#### 2.0.7
* Fixing issue with closing tabs not focusing onto next tab once closed.
* Fixed issue with detecting ajax url correctly which was causing all WPide ajax requests to fail if WordPress was installed in a subdirectory.
* Stopped autocomplete from trying to work when a js/css file is being edited.

#### 2.0.6
* Cleaned up the WPide class and modified the way the class is passed to WordPress actions/filters.

#### 2.0.5
* On startup the editor page now shows extra debugging information for the filesystem API initialization.

#### 2.0.4
* On startup the initial editor page now shows some startup info regarding file permissions to help with debugging.

#### 2.0.3
* If WPide cannot access your files due to permissions then when it starts up it will give you an alert to say this.

#### 2.0.2
* Image editing is now available using the SumoPaint image editor and drawing application http://www.sumopaint.com/

#### 2.0.1
* You can now create new files/folders

#### 2.0
* Recreated this plugin as a dedicated WPide section/app rather than extending the built in plugin/theme editor (just incase WP remove it)
* Now using the WP filesystem API (although currently restricted to local access)
* More security checks on file opening and editing
* Added new file tree for exploring the file system and opening files (any file in wp-content)
* Massive overhaul to code autocomplete functionality with the addition of function information right in the app
* Update the ajaxorg Ace Editor to the current branch
* Tabbed editing

#### 1.0.6
* Added link to meta section of plugin list for easy install of V2 Dev version if you have dismissed the alert.

#### 1.0.5
* Added the facility to download and run the cutting edge development version of WPide from the Github repository

#### 1.0.4
* Implemented JavaScript and CSS mode for better syntax highlighting and checking
* Organize and format source code

#### 1.0.2
* Tidy and comment code
* Added message when backup file is generated
* Adjust code complete dropdown position
* Improved editor responsiveness when using delete or enter keys

#### 1.0.1
* Fixed "Folder name case" issue.

#### 1.0
* Initial release.
