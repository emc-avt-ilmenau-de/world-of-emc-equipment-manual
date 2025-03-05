<!DOCTYPE html>
<html lang="en">
  
    <link rel="stylesheet" href="Frontend\css\styles.css" />
 
  <body>   
    <footer>
    &copy;
    <span id="copyright">
        <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
    </span> {{ __('messages.right_reserved') }}
    |  <a class="privacy-policy-link" target="_blank" href="https://avt-ilmenau.de/de/datenschutzbestimmungen">Datenschutzbestimmungen</a>
    |  <a class="privacy-policy-link" target="_blank"  href="https://avt-ilmenau.de/de/unternehmen/impressum">Impressum</a>

    </footer>
    <script src="{{ asset('Frontend/js/script.js') }}"></script>
  </body>
</html>
