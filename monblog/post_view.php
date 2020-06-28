<h3> 
	<?= strip_tags($data['title']); ?> 
	<em> Modifié le <?= $data['creation_date']; ?></em>
</h3>
<p>
<?= nl2br(strip_tags($data['introduction'])); ?>