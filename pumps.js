// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyDhgOkoIMoHyZsv26-Et8BJNjV2Cc8sN4k",
  authDomain: "zanzibartouristdrivers-f9630.firebaseapp.com",
  projectId: "zanzibartouristdrivers-f9630",
  storageBucket: "zanzibartouristdrivers-f9630.appspot.com",
  messagingSenderId: "75051204770",
  appId: "1:75051204770:web:add58793514c317e9497fb",
  measurementId: "G-TL781EQMW9"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);