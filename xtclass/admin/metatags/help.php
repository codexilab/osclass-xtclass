<section>
	<br><br>

	<h2 class="render-title"><?php _e('Help and documentation', XTCLASS_THEME_FOLDER); ?></h2>

	<h3 class="render-title"><?php _e('- How works?', XTCLASS_THEME_FOLDER); ?></h3>
	<p><?php _e('All the meta tags of the site are build through a json configuration file. If the json file is deleted or badly written, a default metadata written in PHP is loaded, so the site will never stop having meta tags, nor will it affect SEO considerably.'); ?></p>

	<br><br>

	<h3 class="render-title"><?php _e('- How to know which specific page or section to put meta tags?', XTCLASS_THEME_FOLDER); ?></h3>
	<p><?php _e('The first index of the structure of this configuration in JSON format represents the pages:'); ?></p>

	<pre>

{
  "item": [
	</pre>

	<p><?php _e('And sections or sub-pages, separated with slash / :') ?></p>

	<pre>

{
  "item/item_add": [
	</pre>

	<p><?php _e('This is how the program knows which specific page to point to generate their respective meta tags.'); ?></p>

	<br><br>

	<h3 class="render-title"><?php _e('- How are meta tags generated?', XTCLASS_THEME_FOLDER); ?></h3>

	<?php _e('The theme tags are dynamically generated through an array where the key represents an attribute a value its content:'); ?>

	<pre>

{ "key": "value", "key2": "value2" }
	</pre>

	<?php _e('Output:', XTCLASS_THEME_FOLDER); ?>

	<pre>

&lt;meta key="value" key2="vlue2"&gt;
	</pre>

	<br>

	<?php _e('You can add more attributes:', XTCLASS_THEME_FOLDER); ?>

	<pre>
		
{ "key": "value", "key2": "value2", "key3": "value3", "key4": "value4" }
	</pre>

	<?php _e('Output:', XTCLASS_THEME_FOLDER); ?>

	<pre>
		
&lt;meta key="value" key2="vlue2" key3="value3" key4="value4"&gt;
	</pre>

	<br>

	<?php echo osc_esc_html(__('The meta tag </title> is automatically generated when it detects:', XTCLASS_THEME_FOLDER)); ?>

	<pre>
		
{ "name": "title", "content": "{PAGE_TITLE}" }
	</pre>

	<?php _e('Output:', XTCLASS_THEME_FOLDER); ?>

	<pre>

&lt;title&gt;Osclass&lt;/title&gt;<br />&lt;meta name="title" content="Osclass"&gt;
	</pre>

	<br><br>

	<h3 class="render-title"><?php _e('- How add custom content?', XTCLASS_THEME_FOLDER); ?></h3>

	<p><?php _e('You can make use of the new filter <code>meta_tag_filter</code> in PHP.', XTCLASS_THEME_FOLDER); ?></p>

	<p><?php _e('Usage example:', XTCLASS_THEME_FOLDER); ?></p>

<pre>

<?php echo htmlentities('if (!function_exists(\'custom_meta_content\')) {
    function custom_meta_content($data) {
return <<<EOF
<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Person",
  "name": "Manu Sporny",
  "url": "http://manu.sporny.org/about/"
 }
</script>
EOF;
    }
    osc_add_filter(\'meta_tag_filter\', \'custom_meta_content\');
}'); ?>


</pre>

<p><?php _e('In JSON config add the key <code>META_TAG_FILTER</code> and the flag <code>{META_TAG_FILTER}</code> as value:', XTCLASS_THEME_FOLDER); ?></p>

	<pre>
	
{"META_TAG_FILTER": "{META_TAG_FILTER}"}
	</pre>

<?php _e('Output:', XTCLASS_THEME_FOLDER); ?>

<pre>
<?php echo htmlentities('
<script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Person",
  "name": "Manu Sporny",
  "url": "http://manu.sporny.org/about/"
 }
</script>
'); ?>

</pre>

</section>