<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<body>
    <h3>Đây là view</h3>
    <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase.js"></script>

    <script src="https://www.gstatic.com/firebasejs/7.21.1/firebase-analytics.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyCixF05x85kh6pkORyLCA8S2cVHAp5xFhQ",
            authDomain: "notify-1f812.firebaseapp.com",
            databaseURL: "https://notify-1f812.firebaseio.com",
            projectId: "notify-1f812",
            storageBucket: "notify-1f812.appspot.com",
            messagingSenderId: "902720459484",
            appId: "1:902720459484:web:897b722d3b1e9143f9da19",
            measurementId: "G-RVQZG7D065",
        };
        firebase.initializeApp(firebaseConfig);
        var db = firebase.database().ref().child("notification");
        db.on("value", (snap) => console.log(snap.val()));

    </script>
</body>

</html>
