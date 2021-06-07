<div class="container mt-5">
  <div class="row">
    <div class="col-6 col-sm-6">

      <form action="./index.php?content=login_script" method="post" id="loginForm">
        <div class="form-group">
          <label for="inputEmail">Vul hier uw e-mailadres in:</label>
          <input name="email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" autofocus>
          <small id="emailHelp" class="form-text text-muted">Uw privacy is gegarandeerd...</small>
        </div>
        <div class="form-group">
          <label for="inputPassword">Vul hier wachtwoord in:</label>
          <input name="password" type="password" class="form-control" id="inputPassword" aria-describedby="passwordHelp">
          <small id="passwordHelp" class="form-text text-muted">Pas op voor meekijkers tijdens het invoeren...</small>
        </div>
        
        <button type="submit" class="btn btn-lg btn-block mt-4">Log in</button>
      </form>

    </div>
    <div class="col-2"></div>
    <div class="col-4" id="loginForm2">
    <p>Nog geen account? Hier kunt u registreren.</p>
    <a href="index.php?content=register" id="registreerbutton" class="btn btn-outline stretched-link">Registreren</a>
    </div>


  </div>
</div>

