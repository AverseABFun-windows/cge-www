<?php
  require_once 'vrmlengine_functions.php';

  common_header("lets_take_a_walk", LANG_EN,
    "lets_take_a_walk - A small toy ".
    "demonstrating rendering 3d graphic and spatial sound.");

  $toc = new TableOfContents(
    array(
      new TocItem('Download', 'download'),
      new TocItem('Optional command-line options', 'options'),
      new TocItem('Requirements', 'depends'),
      new TocItem('Things used when making this game', 'credits')
    )
  );
?>

<?php
  echo pretty_heading($page_title, VERSION_LETS_TAKE_A_WALK);
  echo default_medium_image_progs_demo("lets_take_a_walk");
?>

<p><b>Let's take a walk</b> is not really a game. It's rather a toy &mdash;
just a demo of what I can achieve with my VRML + OpenGL + OpenAL code
(read: 3d graphic and spatial audio fun). Just download it, gasp in awe,
and have fun for a couple of minutes. Programmers may have fun
for a little longer investigating program's
<?php echo a_href_page('sources', 'kambi_vrml_game_engine'); ?>.

<p>Contents:
<?php echo $toc->html_toc(); ?>

<?php echo $toc->html_section(); ?>

<p>Note that to hear game sounds you should first
<?php echo a_href_page_hashlink('install OpenAL', 'openal_notes',
  'section_install'); ?>. Windows users don't have to do anything,
appropriate DLLs are already is the archive.

<?php
  /* potrzeba mi
     - binarki
     - cross-platform data
     - libpng&zlib
     - openal'a

     pod Windowsem:
     lets_take_a_walk_win.zip zawiera wszystkie trzy pierwsze spakowane
     w jednym zipie - dla wygody wielu ludzi kt�rzy b�d� chcieli uzywac
     mojej gry tylko pod Windowsem i nie zrozumieliby dlaczego musza
     downloadowac az 3 pliki.

     pod Unixami:
     OpenAL i libpng&zlib musza sobie sami zainstalowac. Binarke i data wrzucam
     w jeden plik, lets_take_a_walk_linux.tar.gz, aby bylo analogicznie
     jak pod Windowsem, mimo ze i tak moga chciec wrzucic binarke do innego
     katalogu.

     Dorzucam jeszcze do archiwow docs skopiowane z local_html_versions.
  */
?>

<?php echo_standard_program_download(
  'lets_take_a_walk', 'lets_take_a_walk', VERSION_LETS_TAKE_A_WALK,
  $std_releases_post_1_8_0); ?>

<p><i>Installation</i>: just extract the downloaded archive anywhere.
Run the game binary (<tt>./lets_take_a_walk</tt> on Unix,
<tt>lets_take_a_walk.exe</tt> on Windows).</p>

<p>On Unix, if you don't want to always run the binary from the game's
directory, you can extract the game (or make a symlink to extracted dir)
to <tt>$HOME/.lets_take_a_walk.data/</tt>, or <tt>/usr/local/share/lets_take_a_walk/</tt>,
or <tt>/usr/share/lets_take_a_walk/</tt>. You can then
move or symlink the binary <tt>lets_take_a_walk</tt> to any place
you like (e.g. <tt>$HOME/bin</tt> or <tt>/usr/local/bin</tt>).</p>

<p>Press F1 in the game to get help.

<p><?php echo SOURCES_OF_THIS_PROG_ARE_AVAIL; ?>

<?php echo $toc->html_section(); ?>

<p>You can use various command-line options when running lets_take_a_walk:

<ul>
  <li><?php echo a_href_page_hashlink(
    'Standard command-line options for my programs using OpenAL',
    'openal_notes', 'section_options'); ?>
  <li><?php echo a_href_page(
    'Standard command-line options for my programs using OpenGL',
    'opengl_options'); ?>. Note that by default this program
    runs in fullscreen mode.
  <li><?php echo a_href_page(
    'Standard command-line options for all my programs', 'common_options'); ?>
</ul>

<?php echo $toc->html_section(); ?>

<?php echo depends_ul( array(
  DEPENDS_OPENGL,
  DEPENDS_LIBPNG_AND_ZLIB,
  SUGGESTS_OPENAL,
  DEPENDS_MACOSX) ); ?>

<?php echo $toc->html_section(); ?>

<p>Compiled by <a href="http://www.freepascal.org">FPC</a>.
Important libraries used: <a href="http://www.opengl.org">OpenGL</a>,
<a href="http://connect.creativelabs.com/openal">OpenAL</a>,
<a href="http://www.libpng.org">libpng</a>.

<p>Sounds from
<a href="http://www.a1freesoundeffects.com/">A1 Free Sound Effects</a>.
Textures done with <a href="http://www.gimp.org">GIMP</a>.
<tt>user_help</tt> and <tt>mute_label_scroll</tt> used a little help from
<a href="http://www.imagemagick.org/">ImageMagick</a>.
<tt>base_shadowed.png</tt> generated using my program <tt>gen_light_map</tt>
(available as part of <?php echo a_href_page('engine sources', 'kambi_vrml_game_engine'); ?>,
see <tt>examples/vrml/tools/gen_light_map.pasprogram</tt> file).
Sky in <tt>skies/</tt> done using <a href="http://www.planetside.co.uk/">
Terragen</a>.
<tt>base_b_proc.wrl</tt> done in <a href="http://www.blender3d.org">Blender</a>
and processed using my small <tt>process_base_b</tt> program
(available in <?php echo a_href_page('lets_take_a_walk sources', 'kambi_vrml_game_engine'); ?>,
see <tt>lets_take_a_walk/devel/vrml/process_base_b.pasprogram</tt> file).
<tt>rat.wrl</tt> and <tt>tree.wrl</tt> are modified (using Blender)
files from  <a href="http://www.3dcafe.com">www.3dcafe.com</a>.

<?php
  if (!IS_GEN_LOCAL) {
    $counter = php_counter("lets_take_a_walk", TRUE);
  };

  common_footer();
?>
