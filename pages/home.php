<h1>PrototypeMe</h1>

<p>The purpose of this little experiment is to create a way to piece together a very simplistic site but have the flexibilty to manipulate its structure with out going crazy.</p>
<p>Feature list of this basic engine</p>

<ul>
  <li>abstracted pages</li>
  <li>partials for simplifying widgets and such for repeat content</li>
  <li>Pass common used variabels through pages</li>
  <li>other stuff to be listed</li>
</ul>

<h2>Below is a partial block example</h2>
<?php partial('blocks/_sample-block'); ?>

<h2><a href="<?php print BASEURL;?>foo/bar">Click here to view a page in a nested folder </a></h2>
