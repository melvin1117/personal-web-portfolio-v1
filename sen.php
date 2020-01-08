<!DOCTYPE html>
<html>
<head></head>
<body>
<form name="contact-form" id="contactForm" action="downloademail.php" method="POST">

                <div class="form-group">
                  
                  <input type="text" name="name" class="form-control" id="name" placeholder="Name" required="">
                </div>

                <div class="form-group">
               
                  <input type="email" name="email" class="form-control" placeholder="Email" id="email" required="">
                </div>

                <div class="form-group">
                  
                  <input type="number" name="mob" class="form-control" placeholder="Mobile" id="mob" required="">
                </div>

                <button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-download"></i>&nbsp;Download</button>
              </form>
</body>
</html>