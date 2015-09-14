<div class="block" style="margin-bottom: 0">
    <div class="content" style="border-bottom: none">
        <form id="course_search_block" action="<?php echo $CFG->wwwroot;?>/course/search.php" method="get">
            <fieldset class="coursesearchbox">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search modules ..." id="coursesearchbox" name="search" value="<?php echo $search_clean; ?>">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go</button>
                    </span>
                </div><!-- /input-group -->
            </fieldset>
        </form>
    </div>
</div>