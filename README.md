#Campaign Monitor with Nexmo SMS

<img src= "https://raw.githubusercontent.com/AdvaiyaLabs/Campaign-Monitor-with-Nexmo-SMS/master/Docs/image1.png" width=200>

##Introduction 

**Campaign Monitor with Nexmo SMS** app allows users to send SMS to all the subscribers available in the Campaign Monitor email campaign contact list. It helps users to send SMS not only to campaigns in draft status but also to campaigns in sent and scheduled status.

##Use Case

Send SMS to all the clients’ campaign contact list. SMS can be sent to all the contact lists available in a particular campaign.

##Prerequisites

-   Nexmo subscription and corresponding Nexmo API keys (Key and Secret). To access the API keys, see appendix (Nexmo API Keys)

-   Campaign Monitor subscription and corresponding Campaign Monitor API key. To access the API key, see appendix (Campaign Monitor API Keys)

-   In Campaign Monitor list, custom field of phone number needs to be added. Name of this field can be added in the settings.

-   In Campaign Monitor list, phone number should be in international format.

##Features

-   Send SMS to all the subscribers available in the Campaign Monitor email campaigns.

-   Customize SMS message with a replaceable parameter of Campaign Monitor list.

##Steps to deploy Campaign Monitor with Nexmo SMS app

1.  Visit the target Git repository using the [URL](https://github.com/AdvaiyaLabs/Campaign-Monitor-with-Nexmo-SMS.git)

2.  Click on **Download Zip**; app’s .exe file will get downloaded

3.  Extract the app code

4.  Host the downloaded app code with ftp or any other medium

##Steps to configure and use the Campaign Monitor with Nexmo SMS app

1.  Access the Campaign Monitor with Nexmo App using public URL.

2.  Provide your Nexmo details on the landing page and click on **Update**.

    <img src= "https://raw.githubusercontent.com/AdvaiyaLabs/Campaign-Monitor-with-Nexmo-SMS/master/Docs/image3.png" width=400>

3.  Click on Home button from the top right.

4.  You will land on a home page. Here you need to provide your Campaign Monitor Api key and status of the campaign for which you want to send SMS.

    <img src= "https://raw.githubusercontent.com/AdvaiyaLabs/Campaign-Monitor-with-Nexmo-SMS/master/Docs/image4.png" width=400>

5.  When you provide the Api key, it will display a list of clients registered with that Api key.

6.  Select the client, it will display campaigns created by that client.

7.  Select any of the campaigns, and it will display lists associated with it.

8.  Select the checkboxes for the lists you want to send SMS to and click on **Proceed**.

9.  A textArea will be displayed, you can type your message here and click on **Send SMS**.

    <img src= "https://raw.githubusercontent.com/AdvaiyaLabs/Campaign-Monitor-with-Nexmo-SMS/master/Docs/image5.png" width=400>

##Appendix

Nexmo API Keys
--------------

-   To access the Nexmo keys, go to <https://www.nexmo.com/> and sign-in.

-   On the top right corner, click on the **Api Settings**.

-   Key and Secret will display in the top bar as shown in the below image:

	<img src= "https://raw.githubusercontent.com/AdvaiyaLabs/Campaign-Monitor-with-Nexmo-SMS/master/Docs/image6.png" width=400>

Campaign Monitor API Keys
-------------------------

-   [**Log in**](https://www.campaignmonitor.com/) or [**Sign up**](https://www.campaignmonitor.com/)** .**

-   For new users, a confirmation email will be sent to the registered email ID.

-   Now click on **Clients**.

	<img src= "https://raw.githubusercontent.com/AdvaiyaLabs/Campaign-Monitor-with-Nexmo-SMS/master/Docs/image7.png" width=400>

-   Click on **Account Settings**, in account details section by clicking on **Show API key** link.

-   Copy it and keep it handy.
