<?php
require_once 'castle_engine_functions.php';
castle_header('Supported model formats');

$toc = new TableOfContents(
  array(
    new TocItem('Best formats to use', 'best'),
      new TocItem('glTF 2.0', 'gltf', 1),
      new TocItem('Spine JSON', 'spine', 1),
      new TocItem('X3D and VRML', 'x3d', 1),
      new TocItem('Sprite sheets', 'sprite_sheets', 1),
    new TocItem('Other formats you can use', 'other'),
      new TocItem('Simple images', 'images', 1),
      new TocItem('Animation through a series of static models', 'animation_counter', 1),
      new TocItem('Collada', 'collada', 1),
      new TocItem('OpenInventor', 'open_inventor', 1),
      new TocItem('3DS', '3ds', 1),
      new TocItem('MD3', 'md3', 1),
      new TocItem('Wavefront OBJ', 'wavefront_obj', 1),
      new TocItem('STL', 'stl', 1),
      new TocItem('Videoscape GEO', '', 1),
      new TocItem('Deprecated: Castle Animation Frames (castle-anim-frames) format', 'castle_anim_frames', 1),
  )
);
?>

<p>The following 3D and 2D model formats are supported by <i>Castle Game Engine</i>.
You can load and display them <a href="viewport_and_scenes">using <code>TCastleScene</code> in a viewport</a>.
You can also <a href="view3dscene.php">open them in view3dscene</a>.

<?php echo $toc->html_toc(); ?>

<?php echo $toc->html_section(); ?>

<?php echo $toc->html_section(); ?>

<p>An efficient, modern format for animated 3D and 2D models.

<p>We advise using it in CGE as much as you can. It is supported by a lot of tools. We focus on supporting this format perfectly, with all the features and efficiency.

<p><a href="gltf">Details about glTF support in Castle Game Engine</a>.

<?php echo $toc->html_section(); ?>

<a href="http://esotericsoftware.com/">Spine</a> is a powerful program
for 2D game skeletal animations.
<a href="creating_data_dragon_bones.php">Dragon Bones</a> can also export
to this format.
</p>

<p><a href="https://castle-engine.io/spine">We have a big support for Spine JSON features</a>,
and our friendly game studio <a href="http://cat-astrophe-games.com/">Cat-astrophe Games</a>
is using Spine for all 2D games.

<?php echo $toc->html_section(); ?>

<p><?php echo a_href_page('X3D and VRML', 'vrml_x3d'); ?> is a flexible
and powerful format for 3D models and a basis of our scene graph.

<p>The following extensions are recognized:

<ul>
  <li><p>X3D in classic and XML encoding:
    <code>.x3d</code>, <code>.x3dz</code>, <code>.x3d.gz</code>,
    <code>.x3dv</code>, <code>.x3dvz</code>, <code>.x3dv.gz</code>

  <li><p>VRML 1.0 and 2.0:
    <code>.wrl</code>, <code>.wrz</code> and <code>.wrl.gz</code>.
</ul>

<!-- p>Almost complete VRML&nbsp;1.0 support is done.
VRML&nbsp;2.0 (aka VRML&nbsp;97) and X3D support is also quite advanced,
a lot of nodes and features are implemented (including
advanced texturing and GLSL shaders,
<code>PROTO</code> and <code>EXTERNPROTO</code> support,
events mechanism with routes, sensors and interpolators).
-->

<!-- Among things that work are embedded textures,
semi-transparent materials and semi-transparent textures,
automatic normals smoothing (based on <code>creaseAngle</code>),
triangulating non-convex faces, understanding camera nodes,
WWWInline handling, text rendering and more. -->

<p>We have a great support for X3D and VRML,
and handle rendering, animation, interaction, scripts, shaders
and more features of these formats.
An entire section of this website,
<?php echo a_href_page('Scene Graph (X3D)', 'vrml_x3d'); ?>,
documents all the features we support (from the X3D and VRML standard,
and many of our own extensions).

<p>Note that X3D has a lot of features, and most exporters do not allow to configure everything possible in X3D.
But you can use <code>Inline</code> node to include one file (X3D, glTF or any other that CGE can handle)
within another X3D file, and you can simply write some X3D content by hand.
That's good for adding scripts to 3D data, and generally adding
stuff that is uncomfortable (or impossible) to design in your 3D modeller.
See e.g. <a href="https://github.com/castle-engine/castle-engine/tree/master/examples/fps_game">examples/fps_game/</a> game data for comments,
especially the level file
<a href="https://github.com/castle-engine/castle-engine/blob/master/examples/fps_game/data/example_level/example_level_final.x3dv">examples/fps_game/data/example_level/example_level_final.x3dv</a>.

<!-- <p><i>If your authoring software -->
<!-- can export to X3D, this is the format you should probably use.</i> -->

<?php echo $toc->html_section(); ?>

<p>You can load animations as <i>sprite sheets</i>, defined using various formats:

<ol>
  <li><p><i>Castle Game Engine</i> format (extension <code>.castle-sprite-sheet</code>), created by <a href="manual_editor.php">sprite sheet editor inside the CGE editor</a>.

  <li><p><i>Starling (XML) format</i> (traditionally with <code>.xml</code> extension, in CGE we require you rename them to <code>.starling-xml</code>).

  <li><p><i>Cocos2d format</i> (traditionally with <code>.plist</code> extension, in CGE we advise (but do not require yet) to use <code>.cocos2d-plist</code>).
</ol>

<p>See the <a href="https://castle-engine.io/sprite_sheets">sprite sheets documentation</a>.

<?php echo $toc->html_section(); ?>

<?php echo $toc->html_section(); ?>

<p>You can load image as a scene too. That is, you can load a simple PNG, JPG etc. file using <code>TCastleScene.Load</code> method. It will create a rectangle (which you can use as 3D or 2D object) using this image as a texture, with size adjusted to the image size.

<p>Or, even better, use a dedicated <?php echo cgeRef('TCastleImageTransform'); ?> that is a <a href="viewport_and_scenes">transformation dedicated to loading the image</a>, it has helpful properties to easily adjust image size, repeat, pivot etc.

<p>See also <a href="https://castle-engine.io/using_images">image loading documentation</a>.

<?php echo $toc->html_section(); ?>

<p><b>Animation through a series of static models like <code>xxx000.obj</code>,
<code>xxx001.obj</code>, <code>xxx002.obj</code>...</b>.

<p>This is useful if you have files named like:

<pre>
xxx001.obj
xxx002.obj
xxx003.obj
...
</pre>

<p>You can load such animation from a sequence of files using the URL <code>xxx@counter(3).obj</code>. It's exactly how you can load <a href="x3d_implementation_texturing_extensions.php#section_ext_movie_from_image_sequence">a movie from a sequence of images</a>. See <a href="https://github.com/castle-engine/demo-models/tree/master/blender/skinned_animation/wavefront_obj_animation">demo-models/.../wavefront_obj_animation</a> for an example, you would load them by <code>skinned_anim_@counter(6).obj</code>.

<p>It's not an efficient way to store the animation in a file (or to load it). It is much better to export to X3D or glTF animation, if you can. But it may be useful when you have no other option to export.

<p>Blender exporter to <i>Wavefront OBJ</i> with <i>"Animation"</i> checkbox generates such animation. Hint: uncheck <i>"Write Normals"</i> and check <i>"Keep Vertex Order"</i> in the exporting dialog box, to make sure models are "structurally equal" which allows CGE to merge the animation nicely (even produce more intermediate animation frames, if needed). This also means that CGE will recalculate normals by itself (unfortunately this isn't always desired, because Blender doesn't pass the creaseAngle information to CGE, so CGE cannot smooth the normals as in Blender -- it doesn't know when it should).

<p>The animation is played and smoothed following the same logic as <a href="castle_animation_frames.php">castle-anim-frames</a> format. In a way, using URL <code>xxx@counter(4).obj</code> is just a shortcut for creating a <code>xxx.castle-anim-frames</code> file that would list the appropriate static frames using XML elements.

<?php echo $toc->html_section(); ?>

<p><b><a href="http://www.khronos.org/collada/">Collada</a></b>
(<code>.dae</code> extension).
We support a lot of Collada features &mdash; geometry with materials,
textures, cameras, lights. Tested on many Collada examples,
like <a href="http://collada.org/owl/">Collada Test Model Bank</a>
and Collada models exported from various <a href="http://www.blender.org/">Blender</a>
versions.
All modern Collada versions (1.3, 1.4, 1.5) are handled.

<p>Animations in Collada files are not handled yet.
If you need animations, we advise to use glTF instead.
glTF is newer and has similar feature set.
<a href="https://github.com/KhronosGroup/COLLADA2GLTF">Khronos provides a converter
from Collada to glTF</a>.

<?php echo $toc->html_section(); ?>

<p><a href="http://oss.sgi.com/projects/inventor/"><b>OpenInventor</b></a>
1.0 ASCII files (<code>.iv</code> extension) are handled.
Inventor 1.0 and VRML 1.0 are very similar
formats, we also handle some additional Inventor-specific nodes.

<?php echo $toc->html_section(); ?>

<p><b>3d Studio 3DS format</b>. We support most important things:
meshes, cameras, materials, textures.

<?php echo $toc->html_section(); ?>

<p><b>MD3</b>. This is the format used for models
in Quake 3 and derivatives (<a href="http://tremulous.net/">Tremulous</a>
etc.). Almost everything useful from MD3 file is supported:
geometry with texture (coordinates, and texture filename from
associated <code>xxx_default.skin</code> file), <i>animation is also read
and played</i>.</p>

<?php echo $toc->html_section(); ?>

<p><b>Wavefront OBJ files</b>. We support most important things:
geometry (with texture coords, normal vectors), materials
(colors, opacity, texture filenames).</p>

<?php echo $toc->html_section(); ?>

<p><b>STL (Standard Triangle Language, aka STereoLithography)</b>.
<a href="https://en.wikipedia.org/wiki/STL_%28file_format%29">STL</a> is a simple
popular 3D format used in 3D printing.
We support both ASCII and binary formats.</p>

<?php echo $toc->html_section(); ?>

<p><b><a href="http://paulbourke.net/dataformats/geo/">Videoscape GEO</a></b>
(<code>.geo</code> extension).
Very basic support for this very old 3D format.

<?php echo $toc->html_section(); ?>

<p><?php echo a_href_page('Castle Animation Frames
  (castle-anim-frames) format', 'castle_animation_frames'); ?></b>,
 formerly known as <code>kanim</code>.

<p>This is a simple format for animations, which we used in the past
to <a href="blender">export animated models from Blender</a>.
It supported animating of <i>everything</i> in Blender (transformations, skin,
shape keys, materials, particles, physics...), although it is somewhat
memory-hungry.

<p>We advise now using glTF for all your animation needs.

<?php
castle_footer();
?>
