// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.1/firebase-app.js";
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword, GoogleAuthProvider, FacebookAuthProvider, signInWithPopup, sendPasswordResetEmail, signOut } from "https://www.gstatic.com/firebasejs/10.11.1/firebase-auth.js";
import { getFirestore, setDoc, doc, getDoc } from "https://www.gstatic.com/firebasejs/10.11.1/firebase-firestore.js";

const firebaseConfig = {
  apiKey: "AIzaSyBQqeUcx6gll_ZNZiS3S_Q7P-GuNYvxP3g",
  authDomain: "thelyfex-90b0a.firebaseapp.com",
  projectId: "thelyfex-90b0a",
  storageBucket: "thelyfex-90b0a.firebasestorage.app",
  messagingSenderId: "723857272510",
  appId: "1:723857272510:web:0c50c6c8d0ca87800ff8ef"
};

const app = initializeApp(firebaseConfig);

function showMessage(message, divId) {
  var messageDiv = document.getElementById(divId);
  messageDiv.style.display = "block";
  messageDiv.innerHTML = message;
  messageDiv.style.opacity = 1;
  setTimeout(function () {
    messageDiv.style.opacity = 0;
  }, 5000);
}

const auth = getAuth();
const db = getFirestore();

const registerForm = document.getElementById('register');
registerForm.addEventListener('submit', (event) => {
  event.preventDefault();
  const email = document.getElementById('registerEmail').value;
  const password = document.getElementById('registerPassword').value;
  const fullName = document.getElementById('registerName').value;

  createUserWithEmailAndPassword(auth, email, password)
    .then((userCredential) => {
      const user = userCredential.user;
      const userData = {
        email: email,
        fullName: fullName,
      };
      showMessage('Account Created Successfully', 'signUpMessage');
      const docRef = doc(db, "users", user.uid);
      setDoc(docRef, userData)
        .then(() => {
          window.location.href = 'homepage.html';
        })
        .catch((error) => {
          console.error("error writing document", error);
        });
    })
    .catch((error) => {
      const errorCode = error.code;
      if (errorCode == 'auth/email-already-in-use') {
        showMessage('Email Address Already Exists !!!', 'signUpMessage');
      } else {
        showMessage('unable to create User', 'signUpMessage');
      }
    })
});

const loginForm = document.getElementById('login');
loginForm.addEventListener('submit', (event) => {
  event.preventDefault();
  const email = document.getElementById('loginEmail').value;
  const password = document.getElementById('loginPassword').value;

  signInWithEmailAndPassword(auth, email, password)
    .then((userCredential) => {
      showMessage('login is successful', 'signInMessage');
      const user = userCredential.user;
      localStorage.setItem('loggedInUserId', user.uid);
      document.getElementById('dashboardButton').style.display = 'block'; 
      window.location.href = 'index.html';
    })
    .catch((error) => {
      const errorCode = error.code;
      if (errorCode === 'auth/invalid-credential') {
        showMessage('Incorrect Email or Password', 'signInMessage');
      } else {
        showMessage('Account does not Exist', 'signInMessage');
      }
    })
});

// Google Authentication
const googleBtn = document.querySelector('.google-btn');
googleBtn.addEventListener('click', () => {
  const provider = new GoogleAuthProvider();

  signInWithPopup(auth, provider)
    .then((result) => {
      const user = result.user;
      localStorage.setItem('loggedInUserId', user.uid);
      window.location.href = 'index.html';
    })
    .catch((error) => {
      console.error("Error during Google sign-in", error);
    });
});

// Facebook Authentication
const facebookBtn = document.querySelector('.facebook-btn');
facebookBtn.addEventListener('click', () => {
  const provider = new FacebookAuthProvider();

  signInWithPopup(auth, provider)
    .then((result) => {
      const user = result.user;
      localStorage.setItem('loggedInUserId', user.uid);
      window.location.href = 'index.html';
    })
    .catch((error) => {
      console.error("Error during Facebook sign-in", error);
    });
});

// Forgot Password
const forgotPasswordLink = document.querySelector('.forgot-password');
forgotPasswordLink.addEventListener('click', (event) => {
  event.preventDefault();
  const email = document.getElementById('loginEmail').value;

  sendPasswordResetEmail(auth, email)
    .then(() => {
      showMessage('Password reset email sent!', 'signInMessage');
    })
    .catch((error) => {
      console.error("Error sending password reset email", error);
      showMessage('Error sending password reset email', 'signInMessage');
    });
});

// Show and hide forms
document.getElementById('showLoginBtn').addEventListener('click', () => {
  document.getElementById('dashboard').classList.add('hidden');
  document.getElementById('loginForm').classList.remove('hidden');
  document.getElementById('registerForm').classList.add('hidden');
});

document.getElementById('showRegisterBtn').addEventListener('click', () => {
  document.getElementById('dashboard').classList.add('hidden');
  document.getElementById('registerForm').classList.remove('hidden');
  document.getElementById('loginForm').classList.add('hidden');
});

document.getElementById('backToMain').addEventListener('click', () => {
  document.getElementById('loginForm').classList.add('hidden');
  document.getElementById('dashboard').classList.remove('hidden');
});

document.getElementById('backToMain2').addEventListener('click', () => {
  document.getElementById('registerForm').classList.add('hidden');
  document.getElementById('dashboard').classList.remove('hidden');
});

document.getElementById('showRegister').addEventListener('click', () => {
  document.getElementById('loginForm').classList.add('hidden');
  document.getElementById('registerForm').classList.remove('hidden');
});

document.getElementById('showLogin').addEventListener('click', () => {
  document.getElementById('registerForm').classList.add('hidden');
  document.getElementById('loginForm').classList.remove('hidden');
});

// Toggle Password Visibility
document.querySelectorAll('.toggle-password').forEach(button => {
  button.addEventListener('click', () => {
    const input = button.previousElementSibling;
    if (input.type === 'password') {
      input.type = 'text';
      button.textContent = '🙈';
    } else {
      input.type = 'password';
      button.textContent = '👁';
    }
  });
});

// Show profile details and logout
const showProfileBtn = document.getElementById('showProfile');
showProfileBtn.addEventListener('click', async () => {
  const userId = localStorage.getItem('loggedInUserId');
  if (userId) {
    const docRef = doc(db, "users", userId);
    const docSnap = await getDoc(docRef);
    if (docSnap.exists()) {
      const userData = docSnap.data();
      document.getElementById('profileName').textContent = userData.fullName;
      document.getElementById('profileEmail').textContent = userData.email;
      document.getElementById('profileSidebar').classList.add('open');
    } else {
      console.log("No such document!");
    }
  }
});

document.getElementById('closeSidebar').addEventListener('click', () => {
  document.getElementById('profileSidebar').classList.remove('open');
});

document.getElementById('logoutBtn').addEventListener('click', () => {
  signOut(auth).then(() => {
    localStorage.removeItem('loggedInUserId');
    document.getElementById('profileSidebar').classList.remove('open');
    document.getElementById('showProfile').classList.add('hidden');
    document.getElementById('showLoginBtn').classList.remove('hidden');
    document.getElementById('showRegisterBtn').classList.remove('hidden');
  }).catch((error) => {
    console.error("Error signing out: ", error);
  });
});

// Check if user is logged in
window.addEventListener('load', () => {
  const userId = localStorage.getItem('loggedInUserId');
  const dashboardButton = document.getElementById('dashboardButton');
  if (userId) {
    document.getElementById('showProfile').classList.remove('hidden');
    document.getElementById('showLoginBtn').classList.add('hidden');
    document.getElementById('showRegisterBtn').classList.add('hidden');
    if (dashboardButton) {
      dashboardButton.style.display = 'block';
    }
  } else {
    if (dashboardButton) {
      dashboardButton.style.display = 'none';
    }
  }
});