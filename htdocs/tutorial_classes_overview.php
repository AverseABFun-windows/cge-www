<?php
  require_once 'tutorial_common.php';
  tutorial_header('Classes overview (cheatsheet)');
?>

<p>This final tutorial page summarizes information about
the most important classes and concepts of our engine.
It can be treated like a cheatsheet, concise description of engine architecture.

Note 1: whenever we list "Possible descendants" below, it means "these
are the descendants actually implemented in the engine".
But you are *not* limited to the listed classes.
You *can* define (and "register" or such when necessary)
your own descendants of all existing engine classes.
We tried hard to make the engine really flexible and possible to customize
at various levels.

Note 2: For more details about every class, see API reference,
in particular "Class Hierarchy" page.
Stable engine API reference is online on
http://castle-engine.sourceforge.net/reference.php ,
SVN engine API reference is online on
http://michalis.ii.uni.wroc.pl/castle-engine-snapshots/docs/reference/html/ .

------------------------------------------------------------------------------

/---
| OpenGL context: TCastleWindow / TCastleControl class
\---
  (How to use: Just create, or drop on form, an instance of this class.
   Advanced: you can also make your own class implementing IUIContainer
   interface.)
-> they have a Controls list, that contains instances of TUIControl:

   /---
   | 2D control: TUIControl class
   \---
   Possible descendants:
   |- TCastleButton
   |- TCastleOnScreenMenu
   |- TCastleImageControl
   |- ... and many other common 2D UI stuff (see CastleControls unit
      and some others).
   |- TCastleSceneManager (central knowledge about 3D world; also acts
      as a viewport by default, although you can turn it off by setting
      TCastleSceneManager.DefaultViewport to false, and using only
      TCastleViewport for viewports)
   |- TCastleViewport (refers to TCastleSceneManager instance
      for knowledge about 3D world)
   (How to use: Just create, or drop on form, instances of these class.
    Then call Window.Controls.Add(...).
    Oh, except you don't have to create 1st TCastleSceneManager: TCastleWindow
    and TCastleControl already contain a TCastleSceneManager instance,
    automatically created and available inside their Controls list
    and inside SceneManager property. You can use TCastleWindowCustom /
    TCastleControlCustom to avoid this automatic scene manager &mdash;
    useful if you want to use your custom descendant of TCastleSceneManager.)

   A detailed look at
   /---
   | 3D world knowledge: TCastleSceneManager
   \---
   -> refers to exactly one instance of
      /---
      | Camera handling viewpoint and keys: TCamera
      \---
      Possible descendants:
      |- TWalkCamera
      |- TExamineCamera
      |- TUniversalCamera
         -> contains 1 instance of TWalkCamera (Walk property)
         -> contains 1 instance of TExamineCamera (Examine property)
      (How to use: you can create it (or drop on form),
       and then assign to TCastleSceneManager.Camera (or TCastleViewport.Camera).
       You can also not do anything, and let the automatic creation of camera
       happen at the nearest rendering (more precisely, at ApplyProjection;
       it will create a camera using CreateDefaultCamera and assign it to Camera
       property.)
   -> has a list Items of instances of class
      /----
      | 3D object: T3D
      \---
      Possible descendants:
      |- TCastleScene (3D model, with rendering, collisions and everything)
      |- T3DList (list of T3D instances)
         |- T3DTransform
         |- T3DOrient
            |- TItemOnWorld (special, usage described in more detail later)
            |- T3DAlive
               |- TCreature (special, usage described in more detail later)
               |- TPlayer (special, usage described in more detail later)
      |- TCastlePrecalculatedAnimation
         -> has a list Scenes of TCastleScene
      (How to use: you can create it (or drop on form). And then add to
       SceneManager.Items (or to some another list e.g.
       you can add List1: T3DList to SceneManager.Items,
       and then add Scene: TCastleScene to List1.)
       It's your decision how (and if at all) you need to build a hierarchy
       of 3D objects using lists and transformations. Maybe it's enough to
       just load your whole 3D model as a single TCastleScene?
       *All actual rendering is always eventually done by TCastleScene.*
       (Although all T3D classes have the possibility to render something
       by overriding the Render method, but this feature is simply
       not used for now by existing engine classes &mdash; TCastleScene rendering
       is so versatile that we use it for everything.)
       So everything else than TCastleScene is just for organizing your 3D data.

       Except: usage of TPlayer, TCreature, TItemOnWorld is a little special,
       more about them later.)
   -> MainScene property refers to one (or none) instance of TCastleScene,
      that should also be present in Items. This is used to detect initial
      background, initial viewpoint, initial navigation mode etc. &mdash;
      concepts that have naturally only a single value for the entire 3D world.
      In VRML/X3D, these correspond to a "bindable nodes" &mdash; of course they
      can change during the lifetime of the world, but at a given time
      only one value is active.
      (How to use: To load a game level, you can simply create
       TCastleScene instance, add it to SceneManager.Items, and set it as
       SceneManager.MainScene.
       You can also use the TGameSceneManager.LoadLevel()
       method, usually like this:

<?php echo pascal_highlight(
'Levels.LoadFromFiles(...);
SceneManager.LoadLevel(\'myLevelName\');
// the 2nd line is a shortcut for
// SceneManager.LoadLevel(Levels.FindName(\'myLevelName\'));'); ?>

       This will create TCastleScene, update SceneManager.Items,
       set SceneManager.MainScene, and do some other stuff helpful for typical
       3D games, like handle placeholders &mdash; see TGameSceneManager.LoadLevel
       docs.)

Global Resources list, that contains instances of
/---
| T3DResource
\---
Possible descendants:
|- TCreatureResource
   |- TWalkAttackCreatureResource
   |- TMissileCreatureResource
   |- TStillCreatureResource
|- TItemResource
   |- TItemWeaponResource
(How to use: Put index.xml files with <resource> root in your game's
 data/creatures/ and data/items directories. Call Resources.LoadFromFiles
 at the beginning of your game to create T3DResource instances
 and add them to Resources list.

 Optionally: If you need to have the instances
 available in ObjectPascal code, you can get them like

<?php echo pascal_highlight(
'var
  Sword: TItemWeaponResource;
...
  Sword := Resources.FindName(\'Sword\') as TItemWeaponResource;'); ?>

 You refer to each creature/item resource by it's unique name, so in this example
 you expect that some index.xml will have name="Sword" inside.

 Optionally: you can define your own descendants of T3DResource classes.
 To make them recognized, call

<?php echo pascal_highlight(
'RegisterResourceClass(TItemMeleeWeaponResource, \'MeleeWeapon\');'); ?>

 before doing Resources.LoadFromFiles. This allows you to use
 type="MeleeWeapon" in index.xml files for items.
 Many items may use the same type.

 See http://svn.code.sf.net/p/castle-engine/code/trunk/castle_game_engine/doc/README_about_index_xml_files.txt
 for more details.

 Optionally: it's actually possible to create T3DResource instances
 by pure ObjectPascal code, and add them to Resources list manually,
 without index.xml files. But usually that's not comfortable.
)

Special descendants of T3D:

   /---
   | TCreature
   \---
   (Note that every T3D object knows World, so it knows how to move and collide
    within the 3D world. That's how AI is implemented.
    See T3D.Move, T3D.MoveAllowed, T3D.Height, T3D.LineOfSight methods.)
   -> has Resource property that refers to TCreatureResource
   Possible descendants:
   |- TWalkAttackCreature (has Resource property that refers to TWalkAttackCreatureResource)
   |- TMissileCreature (has Resource property that refers to TMissileCreatureResource)
   |- TStillCreature (has Resource property that refers to TStillCreatureResource)
   (How to use: When you load level using TGameSceneManager.LoadLevel,
    instances of initial creatures/items existing on level are automatically
    created for you,
    replacing the placeholder objects in 3D file. Just add in Blender 3D object
    (with any mesh, geometry doesn't matter, I usually use wireframe cubes)
    and name it 'CasRes' + resource name, like 'CasResAlien'.
    'CasRes' is short for "Castle Game Engine Resource".

    From code, you can also create creatures dynamically, by calling
    Resource.CreateCreature. For example

<?php echo pascal_highlight(
'var
  Alien: TCreatureResource;
...
  Alien := Resources.FindName(\'Alien\') as TCreatureResource;
...
  Alien.CreateCreature(...);'); ?>

   )
   This is a good way to dynamically make creatures spawn in the 3D world
   (e.g. maybe you make an ambush, or maybe you want to create a "rush"
   when monsters attack in waves, or maybe you want to make a crowd...).
   Make sure that all necessary creatures are declared in level's index.xml
   file under <resources>, to prepare creatures at level loading
   (you don't want to cause a sudden delay in the middle of the game).
   T3DResource and LoadLevel methods will then take care of loading resources
   when necessary.

   /---
   | TItemOnWorld
   \---
   -> has Item property that refers to 1 instance of
      /---
      | TInventoryItem
      \---
      -> has Resource property that refers to TItemResource
      Possible descendants:
      |- TItemWeapon (has Resource property that refers to TItemWeaponResource)
   (How to use: similar to creatures, see notes above. Items are very similar,
    except TInventoryItem is *not* a 3D object (it cannot be directly added to the
    level), only TItemOnWorld is a 3D object.
    - TGameSceneManager.LoadLevel automatically creates instances of TItemOnWorld,
      along with instances of Item, referring to item resources on Resources.
      This looks at placeholders: just create in Blender object named
      'CasRes' + item resource name.
    - You can create TInventoryItem instance by code by Resource.CreateItem
    - You can create TItemOnWorld instance by code by Item.PutOnWorld

   /---
   | TPlayer
   \---
   -> has a list Inventory of instances of TInventoryItem
   (How to use: just create an instance of TPlayer, and add it
    to SceneManager.Items, like all normal T3D descendants.
    You will also almost always want to set this as SceneManager.Player,
    to make it a central player (connected with central camera etc.).)

<?php
  tutorial_footer();
?>
