import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:get/get.dart';


Future<void> handleBackgroundMessage(RemoteMessage message) async{

  print('herererere');
  print('Title ${message.notification?.title}');
  print("Body ${message.notification?.body}");
  print("Payload: ${message.data}");

}


class FireBaseApi{
  final _firebaseMessaging = FirebaseMessaging.instance.subscribeToTopic('allChannel');


  Future<void> initNotifications() async {
    //this function will request permission from the user for the server to send notis
    //await _firebaseMessaging.requestPermission();
    //this token is unique for every user so in case of large scale app this token will be created when the user register and saved with his creds
    // final fCMtoken = await _firebaseMessaging.getToken();
    //  print("Token : $fCMtoken");
    // print t here so i can use it in php file , this token in my case is static
    FirebaseMessaging.onBackgroundMessage(handleBackgroundMessage);
     FirebaseMessaging.onMessage.listen((RemoteMessage message)  {
       Get.snackbar(message.notification!.title.toString(),message.notification!.body.toString());

    });


  }
}