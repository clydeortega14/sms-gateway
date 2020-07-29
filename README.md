# SMS-Gateway

SMS-Gateway is a Laravel Web application. This application can send text messages like notifications, announcements and etc. with participation of GLOBELABS our third party application.



# Project Details

Frontend: bootstrap, javascript

Backend:  Laravel 5.6



## Installation

1. Install [PHP](http://windows.php.net)

2. Install [Composer](https://getcomposer.org/Composer-Setup.exe)

   - Make sure your PHP directory is referenced.

3. Install [Git](https://git-scm.com/download/win)

4. Install any text-editor: [Sublime Text 3](https://download.sublimetext.com/Sublime%20Text%20Build%203143%20x64%20Setup.exe), [Visual Studio Code](https://code.visualstudio.com/docs/?dv=win)

5. Open Git Bash and type the following:

   - `composer global require laravel/installer`
   - `cd ~`
   - `git clone http://gitlab.coredev.ph/coretech/global-sms-gateway.git`
   - `cd global-sms-gateway`
   - `composer install`
   - `mv .env.example .env`
   - `php artisan key:generate`

6. Open your downloaded text-editor and open the folder of `global-sms-gateway`

7. Modify environment variables in `.env` file:

   - `DB_PORT=`
   - `DB_DATABASE=`
   - `DB_USERNAME=`
   - `DB_PASSWORD=`

8. Switch back to Git Bash and run the following:

   - `php artisan serve`
   - `localhost:8000`

9. Congrats, you're all set!



   ## Features

   1. Authentication and Login

   2. Create User Credentials and Globe Credentials

   3. Make Payment

   4. Send Messages to all networks


   ## Credentials

   ### Super Admin 

   Username -

   Password - 

   ### Admin 

   Username -

   Password - 

   ### Users 

   Username -

   Password - 





## Screenshots

### LoginPage

![](D:/coreDevFiles/SMS-Gateway/global-sms-gateway/public/docs/login_page.png)







# Super Admin Account



### Dashboard Overview

![](D:/coreDevFiles/SMS-Gateway/global-sms-gateway/public/docs/SuperAdmin/dashboard_view.png)

### Create Client Account

![](D:/coreDevFiles/SMS-Gateway/global-sms-gateway/public/docs/SuperAdmin/create_client_account.png)



### Create Globe and Subscription Credentials

![](D:/coreDevFiles/SMS-Gateway/global-sms-gateway/public/docs/SuperAdmin/create_globe_credentials_and_subscriptions.png)



### Create Payment

![](D:/coreDevFiles/SMS-Gateway/global-sms-gateway/public/docs/SuperAdmin/create_bills_payment.png)



### Changing Subscription active/inactive

![](D:/coreDevFiles/SMS-Gateway/global-sms-gateway/public/docs/SuperAdmin/changing_subscriptionType_activeOrinactive.png)

### Disable Account or Change Subscription Type Postpaid/Prepaid

![](D:/coreDevFiles/SMS-Gateway/global-sms-gateway/public/docs/SuperAdmin/disable_account_and_update subscriptionType.png)





## Resources

1. [Laravel Documentation](https://laravel.com/docs/5.6)
2. [Laracasts](https://laracasts.com)
3. [Bootstrap](https://getbootstrap.com/)