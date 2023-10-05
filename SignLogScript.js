 const loginLink = document.getElementById("loginLink");
const signupLink = document.getElementById("signupLink");
const loginForm = document.getElementById("loginForm");
const signupForm = document.getElementById("signupForm");

loginLink.addEventListener("click", () => {
    loginForm.classList.remove("hidden");
    signupForm.classList.add("hidden");
    });

signupLink.addEventListener("click", () => {
    loginForm.classList.add("hidden");
    signupForm.classList.remove("hidden");
    });

//validation part sign up form ..........
function Signvalidation() {
    const fname = document.getElementById('fname').value;
    const lname = document.getElementById('lname').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const password = document.getElementById('password').value;
    const cpassword = document.getElementById('cpassword').value;
  
    document.querySelectorAll('.error').forEach(error => {
      error.innerText = '';
    });
  
    let isValid = true;
    const name = /^[A-Za-z]+$/;
    const phoneReg = /^\d{10}$/;
    const emailReg = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    const passwordReg = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/;
    if(fname != '')
    {
        if(!name.test(fname))
        {
            isValid = false;
            document.getElementById('fnameError').innerText = 'No are Not allowed'; 
        }
    }
    else
    {
        isValid = false;
        document.getElementById('fnameError').innerText = 'First Name is required';
    }
    if(lname != '')
    {
        if(!name.test(lname))
        {
            isValid = false;
            document.getElementById('lnameError').innerText = 'No are Not allowed'; 
        }
    }
    else
    {
        isValid = false;
        document.getElementById('lnameError').innerText = 'Lirst Name is required';
    }
    if(phone != '')
    {
        if(!phoneReg.test(phone))
        {
            isValid = false;
            document.getElementById('phoneError').innerText = 'Enter valid Phone No'; 
        }
    }
    else
    {
        isValid = false;
        document.getElementById('phoneError').innerText = 'Phone No is required';
    }
  
    if(email != '')
    {
        if (!emailReg.test(email)) 
        {
            isValid = false;
            document.getElementById('emailError').innerText = 'Invalid email address';
        }
        
    }
    else
    {
        isValid = false;
        document.getElementById('emailError').innerText = 'Email is required';
    }
    
    if(password != '')
    {
        if (!passwordReg.test(password)) 
        {
        isValid = false;
        document.getElementById('passwordError').innerText = 'Password does not meet the requirements';
        }
    }
    else
        {
            isValid = false;
            document.getElementById('passwordError').innerText = 'Password is required';
        }
  
    if (password !== cpassword) {
      isValid = false;
      document.getElementById('cpasswordError').innerText = 'Passwords do not match';
    }
  
    return isValid;
  }
  
// Log in validation...........
function Logvalidation()
{
    console.log("hello");
    const email = document.getElementById('logemail').value;
    const password = document.getElementById('logpassword').value;

    document.querySelectorAll('.error').forEach(error => {
        error.innerText = '';
      });
    let isValid = true;
    const emailReg = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    const passwordReg = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/;

    if(email != '')
    {
        if (!emailReg.test(email)) 
        {
            isValid = false;
            document.getElementById('logemailError').innerText = 'Invalid email address';
        }
        
    }
    else
    {
        isValid = false;
        document.getElementById('logemailError').innerText = 'Email is required';
    }

    if(password != '')
    {
        if (!passwordReg.test(password)) 
        {
        isValid = false;
        document.getElementById('logpasswordError').innerText = 'Password does not meet the requirements';
        }
    }
    else
        {
            isValid = false;
            document.getElementById('logpasswordError').innerText = 'Password is required';
        }
    
    return isValid;
}