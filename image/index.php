<!DOCTYPE html>
<html>
<head>
	<title>Image Upload Using PHP</title>
	<style>
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			min-height: 100vh;
		}
	</style>
</head>
<body>


<head>
    
    <title>formulaire</title>
</head>
<body>

<form method="post" action="traitement.php">
<label>Id</label>
<input type="text" name="id"> <br/>

<label>nom</label>
<input type="text" name="nom"> <br/>

<label>prenom</label>
<input type="text" name="prenom"> <br/>


<label>email</label>
<input type="email" name="email"> <br/>

<label>telephone</label>
<input type="number" name="telephone"> <br/>




<label>pays</label>
<input type="text" name="pays"> <br/>

<label>association</label>
<input type="text" name="association"> <br/>

<label>Login</label>
<input type="text" name="login"> <br/>


<label>mot de passe</label>
<input type="password" name="motDePasse"> <br/>





    







</form>
    







</body>
</html>
	<?php if (isset($_GET['error'])): ?>
		<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>
     <form action="upload.php"
           method="post"
           enctype="multipart/form-data">

           <input type="file" 
                  name="my_image">

           <input type="submit" 
                  name="submit"
                  value="Upload">
     	
     </form>
</body>
</html>