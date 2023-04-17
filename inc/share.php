<?php function share() {
	$bloginfo = get_bloginfo('url'); // adresse du blog

	$titre = get_the_title(); // titre de l'article

	$pmlink = get_permalink(); // adresse de l'article
?>

	<a class="btn-share btn-share-print" href="#"><span>Imprimer</span></a>

	<a class="btn-share btn-share-mail" href="mailto:?subject=Article sur <?php bloginfo('name'); ?>&amp;body=Un article interessant sur <?php bloginfo('name'); ?> : <?php echo $titre;?>... Adresse : <?php echo $pmlink; ?>" title="Envoyer par email : <?php echo $titre;?>" rel="nofollow" ><span>Mail</span></a>

	<a class="btn-share btn-share-fb" href="http://www.facebook.com/share.php?u=<?php echo $pmlink; ?>" title="Partager sur Facebook : <?php echo $titre;?>"target="_blank" rel="nofollow"> <span>Facebook</span></a>

	<!-- <a href="http://twitter.com/home?status=<?php echo $pmlink; ?>" target="blank" rel="nofollow" ><img title="Partager sur Twitter : <?php echo $titre;?>"/><span>Twitter</span></a> -->

	<!-- <a href="http://www.netvibes.com/share?title=<?php echo $titre;?>&amp;url=<?php echo $pmlink; ?>" target="blank" rel="nofollow" ><img title="Partager sur Netvibes : <?php echo $titre;?>"/><span>Netvibes</span></a> -->

	<!-- <a href="http://www.wikio.fr/vote?url=<?php echo $pmlink; ?>" target="blank" rel="nofollow" ><img title="Voter sur Wikio pour : <?php echo $titre;?>"/><span>Wikio</span></a> -->

	<!-- <a href="<?php echo $pmlink; ?>feed" target="blank" rel="nofollow" ><img title="Suivre les réponses par RSS à : <?php echo $titre;?>" /><span>Flux RSS</span></a> -->




<?php
}
?>