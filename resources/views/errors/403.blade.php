<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>404 Error Page | Mediaone </title>
      <link rel="icon" type="image/x-icon" href="{{asset('images/global_images/media_one_logo.jpg')}}">
      <link rel="stylesheet" href="style.css">
      <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        *{
  margin: 0;
  padding: 0;
  outline: none;
  box-sizing: border-box;
  font-family: 'Ubuntu', sans-serif;
}
body{
  height: 100vh;
  background: -webkit-repeating-linear-gradient(-45deg, #1164B5, #1184C2, #0C99BA, #21A5B7, #30BFBF, #8DD9CC);
  background-size: 400%;
}

#error-page{
  position: absolute;
  top: 10%;
  left: 15%;
  right: 15%;
  bottom: 10%;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 15px;
  background: #fff;
  box-shadow: 0px 5px 10px rgba(0,0,0,0.1);
}

#error-page .content{
  max-width: 600px;
  text-align: center;
}

.content h2.header{
  font-size: 1200%;
  width: 100%;
  max-width: 100%;
  line-height: 1em;
  position: relative;
}



.content h2.header:after{
  position: absolute;
  content: attr(data-text);
  top: 0;
  left: 0;
  right: 0;
  background: -webkit-repeating-linear-gradient(-45deg, #0d3490, #1164B5, #1184C2, #0C99BA, #21A5B7, #30BFBF, #8DD9CC);
  background-size: 400%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  text-shadow: 1px 1px 2px rgba(255,255,255,0.25);
  animation: animate 4s ease-in-out infinite;
}

@media (max-width: 768px) {
  .content h2.header {
    font-size: 850%; /* Adjust font size for smaller screens */
  }
}

/* Media query for even smaller screens */
.content h2.header (max-width: 480px) {
  h2 {
    font-size: 16px; /* Further adjust font size for even smaller screens */
  }
}

@keyframes animate {
  0%{
    background-position: 0 0;
  }
  25%{
    background-position: 100% 0;
  }
  50%{
    background-position: 100% 100%;
  }
  75%{
    background-position: 0% 100%;
  }
  100%{
    background-position: 0% 0%;
  }
}

.content h4 { /* PAGE NOT FOUND */
  margin-bottom: 20px;
  text-transform: uppercase;
  color: #000;
  font-size: 2.3em;
  width: 100%;
  max-width: 100%;
  position: relative;
}



.content p { /* SORRY, PAGE DOES NOT EXIST.... */
  font-size: 20px;
  color: #0d0d0d;
}

.content .btns {
  margin: 25px 0;
  display: inline-flex;
}

.content .btns a {  /* RETURN HOME BUTTON */
  display: inline-block;
  margin: 0 10px;
  text-decoration: none;
  font-family: 'Ubuntu', sans-serif;
  background-color: #7bafba;
  color: #fff;
  padding: 12px 25px;
  border-radius: 7px;
  text-transform: uppercase;
  transition: all 0.3s ease;
  
}

@media only screen and (min-width: 768px) {
  /* Add your desired breakpoint value */
  .content .btns {
    max-width: 200px; /* Add your desired max-width value */
  }
}

.content .btns a:hover{
  background: #5bd485;
  color: #fff;
}
      </style>
   </head>
   <body>
      <div>
        <div id="error-page">
          <div class="content">
            <h2 class="header" data-text="403">
                403
            </h2>
            <h4 data-text="FORBIDDEN PAGE">
                FORBIDDEN PAGE
            </h4>
            <p>
              You do not have the permission to access this page.
            </p>
            <div class="btns">
                <a href="/">Return Home</a>
            </div>
          </div>
      </div>
    </div>
    </div>
    <script src="WebsitePractice.js"></script>
  </body>
</html>