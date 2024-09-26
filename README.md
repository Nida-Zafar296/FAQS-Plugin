# FAQS-Plugin
# Introduction
The FAQs Plugin for WordPress allows you to create, manage, and display Frequently Asked Questions (FAQs) on your website. With features like categories, tags, search functionality, and a user-friendly accordion layout, this plugin enhances user experience and provides valuable information to your visitors.

# Working Video

<a href="https://drive.google.com/file/d/1bjDtabjzXlyQSzd4kNUuQlrZLSfEoKHI/view?usp=sharing" target="_blank">
  Working video
</a>

# screenshots

<a href="https://drive.google.com/file/d/1eCEnJfxPLuZAlQfkOdO8bDST0gWNyWzi/view?usp=sharing" target="_blank">
  page layout
</a>


# Installation
# Installing via WordPress Admin
1. Download the plugin
  - Download the ZIP file of the FAQs plugin from the repository.
2. Upload plugin
  - Log in to your WordPress admin panel.
  - Go to Plugins > Add New.
  - Click on the Upload Plugin button and choose the ZIP file you downloaded.
  - Click Install Now.
3. Activate the Plugin:
  - After installation, click on Activate to enable the plugin.  
# Manual Installation
  - Download the plugin ZIP file from [your source].
  - Extract the ZIP file.
  - Upload the faqs-plugin folder to your /wp-content/plugins/ directory using FTP.
  - Go to your WordPress dashboard, navigate to Plugins, and activate the plugin.

# Setup and Configuration

1. Create Custom Taxonomies:
  - After activation, the plugin will automatically create two custom taxonomies: FAQ Categories and FAQ Tags. You can manage these under FAQs > Categories and FAQs > Tags.
2. Add FAQs:
  - Navigate to FAQs in the WordPress admin menu.
  - Click Add New to create a new FAQ.
  - Enter the Question as the title and the Answer in the content area.
  - Assign the FAQ to relevant Categories and Tags on the right sidebar.
  - Publish the FAQ when you're done.
3. Customize Plugin Settings:
  -  plugin supports customizable settings (e.g., background color, icons), navigate to the settings page under FAQs > Settings.
  - Adjust the options as desired and save your changes.
4. Adding the FAQ Display:
  - Use the shortcode [faq_accordion_by_category] to display the FAQs on any post or page. Simply paste the shortcode into the content editor where you want the FAQs to appear.

#  Usage

1. Viewing FAQs:
    - Users can view FAQs organized by categories and tags. They can search for specific FAQs using the search bar provided.
2. Interactivity:
    - Each FAQ item can be expanded or collapsed. Users can like or dislike FAQ items, and the counts will update accordingly.
3. Sidebar Widget:
    - If you have set up widgets, you can display additional content related to FAQs in the sidebar using the FAQs Widget Area.

# Troubleshooting Tips

1. FAQs Not Displaying:
    - Ensure that you have published FAQs and assigned them to categories or tags.
    - Check if the shortcode is placed correctly in your post or page.
2. Styles Not Applying:
    - Clear your browser cache and refresh the page using (ctrl + F5).
    - Ensure that you have correctly enqueued your styles in the plugin.
3. JavaScript Errors:
    - Check for console errors in your browser's developer tools using F12.
    - Ensure that the jQuery library is loaded on your site.
4. Like/Dislike Functionality Not Working:
    - Ensure that AJAX is properly set up and that your server can handle AJAX requests.
    - Check for any JavaScript errors that may affect AJAX functionality.
5. Categories or Tags Missing:
    - Ensure that you have created categories and tags under FAQs > Categories and FAQs > Tags.
    - Check if the taxonomies are registered correctly in your plugin code.

# FAQs
  - Can I change the icons for like/dislike buttons?
       - Yes, you can update the URLs for the like and dislike icons in the plugin settings.
  - Is the plugin compatible with all WordPress themes?
       - The plugin is designed to work with most themes, but some custom themes may require additional CSS adjustments.
  - Can I add images to FAQs?
       - Yes, you can add images to the FAQ answer content using the WordPress editor.
  - How do I uninstall the plugin?
       - To uninstall, go to Plugins in the WordPress admin, deactivate the plugin, and then click Delete. This will remove the plugin files from your WordPress installation.
  -  How do I add an FAQ block to my WordPress page?
       - Register the FAQ Block
       - Access Gutenberg Editor
       - Insert the FAQ Block
       - Add Question and Answer
       - Publish the Page
  - How can I add a widget to my WordPress page?
       - Log in to your WordPress Dashboard.
       - Navigate to "Appearance" > "Widgets".
       - Choose a widget from the available list on the left side.
       - Drag and drop the widget to the desired widget area (e.g., Sidebar, Footer).
       - Customize the widget settings, if applicable, such as title or content.
       - Save the changes to apply the widget to your WordPress page.


# Support
  - If you encounter any issues or have questions about the plugin, please reach out for support:
   - Email: [nidazafar006@gmail.com]
