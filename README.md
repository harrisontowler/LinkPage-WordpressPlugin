# LinkPage-WordpressPlugin
This is a wordpress plugin that can be installed to your site. It works exactly the same as Linktr.ee but with a a few added features.

In a nutshell?:
since I have built this code to work with woocommerce in mind, the plugin allows all users to have their own personal shop where they can sell physical/digital content. The version I am using also has dokan multivendor-marketplace installed (which converts woocommerce into a multivendor site similar to ebay) this allows more than one user to sign up and have their own Link-Page and shop associated with said link-page.

Functionality:
What does the code actually do?
The way I have structured the code is as follows,
The user (when on their personal link-page) will be prompted with a user-input-field. The input field allows Spotify/Soundcloud(playlists or single tracks)/youtube/Twitter urls so when a user pastaes the url of a shared video or song the code automatially converts the embed to an iframe. This saves the user actually searching for the embed link on something they want to share. They can simply copy and paste the share url and the code converts the output to an iframe which then displays the choses url into a widget.
These widgets will be shown with a dropdown handle to the left hand side of the uploaded link when submitted. If it is pressed the widget opens like so [INSERT IMAGE]
and can be toggled to close the display after.

If the user choses not to press the toggle button and simply wants to visit the link which the user uploaded (this is not visable front end) they can simply press the element with the users desired text to visit the url
[INSERT IMAGE]

The code regognises whether or not the user has uploaded one the of the urls that will create a widget or not and assign the toggle button accordingly.
Along with this, the user has the ability to choose the border-color/background-color/text-color/text/border-radius of the element before uploading it so they can ucstomise it how they please. This will be displayed as a preview shown in real time so they can decide whether they would like to ammend the css of the element before uploading.[INSERT IMAGE]

The user also has the option to rearrange the elements in real time without a save button. Once the user places the element wherer they would like it to go in the new position, it is automatically saved nback end. [INSERT IMAGE]
