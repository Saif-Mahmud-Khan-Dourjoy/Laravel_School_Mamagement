<?php

use Illuminate\Database\Seeder;

class MissingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Permissions = new \App\Permission();
        $Permissions->name="attendanceReport.search";
        $Permissions->description="Can Search for Attendance";
        $Permissions->modual="Attendance Report";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="attendanceReport.view";
        $Permissions->description="Can Show Searched Attendance";
        $Permissions->modual="Attendance Report";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="generalSettings.index";
        $Permissions->description="Can Show Settings Form";
        $Permissions->modual="Settings";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="generalSettings.store";
        $Permissions->description="Can Add or Update Settings";
        $Permissions->modual="Settings";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="collectionReport.search";
        $Permissions->description="Can Search Collection Report";
        $Permissions->modual="Collection Report";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="collectionReport.view";
        $Permissions->description="Can View Collection Report";
        $Permissions->modual="Collection Report";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="expectedCollections.index";
        $Permissions->description="Can View List";
        $Permissions->modual="Expected Collection";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="expectedCollections.create";
        $Permissions->description="Can Show Create Page";
        $Permissions->modual="Expected Collection";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="expectedCollections.store";
        $Permissions->description="Can Save Data";
        $Permissions->modual="Expected Collection";
        $Permissions->Save();


        $Permissions = new \App\Permission();
        $Permissions->name="expectedCollections.show";
        $Permissions->description="Can Show View Page";
        $Permissions->modual="Expected Collection";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="expectedCollections.edit";
        $Permissions->description="Can Show Edit Page";
        $Permissions->modual="Expected Collection";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="expectedCollections.update";
        $Permissions->description="Can Update";
        $Permissions->modual="Expected Collection";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="expectedCollections.destroy";
        $Permissions->description="Can Delete";
        $Permissions->modual="Expected Collection";
        $Permissions->Save(); 

        //route for SMS
        $Permissions = new \App\Permission();
        $Permissions->name="smsNotification";
        $Permissions->description="Can view SMS page";
        $Permissions->modual="Send SMS";
        $Permissions->Save(); 

        $Permissions = new \App\Permission();
        $Permissions->name="sms.loadInfo";
        $Permissions->description="Can Load Info for SMS";
        $Permissions->modual="Send SMS";
        $Permissions->Save(); 

        $Permissions = new \App\Permission();
        $Permissions->name="sms.send";
        $Permissions->description="Can Send SMS";
        $Permissions->modual="Send SMS";
        $Permissions->Save(); 


        //permission for notification Receiver
        $Permissions = new \App\Permission();
        $Permissions->name="notification-receivers.index";
        $Permissions->description="Can View List";
        $Permissions->modual="Notification Receiver";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="notification-receivers.create";
        $Permissions->description="Can Show Create Page";
        $Permissions->modual="Notification Receiver";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="notification-receivers.store";
        $Permissions->description="Can Save Data";
        $Permissions->modual="Notification Receiver";
        $Permissions->Save();


        $Permissions = new \App\Permission();
        $Permissions->name="notification-receivers.show";
        $Permissions->description="Can Show View Page";
        $Permissions->modual="Notification Receiver";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="notification-receivers.edit";
        $Permissions->description="Can Show Edit Page";
        $Permissions->modual="Notification Receiver";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="notification-receivers.update";
        $Permissions->description="Can Update";
        $Permissions->modual="Notification Receiver";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="notification-receivers.destroy";
        $Permissions->description="Can Delete";
        $Permissions->modual="Notification Receiver";
        $Permissions->Save();

         //permission for occasional SMS
        $Permissions = new \App\Permission();
        $Permissions->name="occasional-notifications.index";
        $Permissions->description="Can View List";
        $Permissions->modual="Occasional SMS";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="occasional-notifications.create";
        $Permissions->description="Can Show Create Page";
        $Permissions->modual="Occasional SMS";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="occasional-notifications.store";
        $Permissions->description="Can Save Data";
        $Permissions->modual="Occasional SMS";
        $Permissions->Save();


        $Permissions = new \App\Permission();
        $Permissions->name="occasional-notifications.show";
        $Permissions->description="Can Show View Page";
        $Permissions->modual="Occasional SMS";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="occasional-notifications.edit";
        $Permissions->description="Can Show Edit Page";
        $Permissions->modual="Occasional SMS";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="occasional-notifications.update";
        $Permissions->description="Can Update";
        $Permissions->modual="Occasional SMS";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="occasional-notifications.destroy";
        $Permissions->description="Can Delete";
        $Permissions->modual="Occasional SMS";
        $Permissions->Save();  

        $Permissions = new \App\Permission();
        $Permissions->name="transfer-certificate.index";
        $Permissions->description="Can Generate TC";
        $Permissions->modual="Transfer Certificate";
        $Permissions->Save();

        $Permissions = new \App\Permission();
        $Permissions->name="transfer-certificate.pdf";
        $Permissions->description="Can Print TC";
        $Permissions->modual="Transfer Certificate";
        $Permissions->Save();  
    }
}
