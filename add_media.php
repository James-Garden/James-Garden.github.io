<?php include 'header.php'?>

<?php
if (!isAdmin()) {
  invoke401();
}
?>
<h1>Add Media</h1>

 <form class="mysql-input" method="post" action="submit_media.php">
   <p>Name</p>
   <input type="text" name="media_name" placeholder="Name" maxlength="80" required><br>
   <p>Rating</p>
   <input type="text" name="media_rating" placeholder="9.6" inputmode="decimal" pattern="[0-9].[0-9]"><br>
   <p>Cover Image</p>
   <input type="file" name="media_cover" required><br>
   <p>Description</p>
   <textarea name="media_desc" placeholder="Description..." maxlength="65535" rows="5" cols="50" required></textarea><br>
   <p>Media Type</p>
   <select name="media_type" id="media_type" placeholder="">
     <option disabled selected value>--Media Type--</option>
     <option value="film">Film</option>
     <option value="tv_series">TV Series</option>
     <option value="book">Book</option>
   </select>
   <script>

   </script>
   <div id="book_form" style="display:none;">
     <p>Number of Chapters</p>
     <input type="number" name="chapter_number"><br>
     <p>initial Release Date</p>
     <input type="date" name="release_date_book"><br>
   </div>
   <div id="film_form" style="display:none;">
     <p>Runtime (Minutes)</p>
     <input type="number" name="runtime"><br>
     <p>Initial Release Date</p>
     <input type="date" name="release_date_film"><br>
   </div>
   <div id="tv_form" style="display:none;">
     <p>Number of Episodes</p>
     <input type="number" name="episode_count"><br>
     <p>First Episode Aired</p>
     <input type="date" name="first_aired"><br>
     <p>Last Episode Aired</p>
     <input type="date" name="last_aired"><br>
   </div>
   <br><br>
   <button type="submit">Submit</button>
 </form>
<?php include 'footer.php'?>
