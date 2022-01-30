<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Firebase Phone Authentication</title>
  <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>

  <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
  <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-analytics.js"></script>

  <!-- Add Firebase products that you want to use -->
  <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-firestore.js"></script>
    <script>
        var firebaseConfig = {
        // apiKey: "AIzaSyAxpp29gpMYtii4gUTn7iz0EOIisNOJyoQ",
        // authDomain: "laraveltesting-a97b8.firebaseapp.com",
        // databaseURL: "https://laraveltesting-a97b8.firebaseio.com",
        // projectId: "laraveltesting-a97b8",
        // storageBucket: "laraveltesting-a97b8.appspot.com",
        // messagingSenderId: "567750413175",
        // appId: "1:567750413175:web:cfd77cada72d1aadcc6f72",
        // measurementId: "G-N2BHPZG2XF"
        
        apiKey: "AIzaSyAvHLhMRTVgkt56f2ZXJ-yVtp7w1-6OfIs",
        authDomain: "patienthistory-a8d55.firebaseapp.com",
        databaseURL: "https://patienthistory-a8d55.firebaseio.com",
        projectId: "patienthistory-a8d55",
        storageBucket: "patienthistory-a8d55.appspot.com",
        messagingSenderId: "563765055218",
        appId: "1:563765055218:web:e4c6149fa29e646dc8ca6b",
        measurementId: "G-ENDGKJ41LC"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    // firebase.analytics();
    </script>

</head>
<body>
<form>
    <input  type = "text" id="number" placeholder="+2255552">
    <div id="recaptcha-container"></div>
    <button  onclick="phoneAuth();">Send Code </button>
</form>
<h1>Vervcation</h1>
<form>
    <input type="text" id="verfcation" placeholder="Enter Vervcation code">
    <input type="text" id="verfcation" placeholder="edit Vervcation code">
    <button onclick="codevervcation();">Verfication</button>
</form>
<script src="{{url('js/firebase.js')}}"></script>
</body>
</html>
