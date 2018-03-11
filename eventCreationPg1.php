
<!--This is PHP to be implemented into the page "create-event.php"-->

<div class="container">

    <div class="main">
        <span id="error">
        </span>
        <form id="eventCreator" action="eventCreationPg2.php" autocomplete="off" method="post">
            <table style="width=100%;" class = "listing">
                <tr>
                    <td><label>Event Name :<span>*</span></label></td>
                    <td><input name="name" maxlength="32" type="text" placeholder="eg: Winter Marathon" required></td>
                </tr>
                <tr>
					<td><label>Description :</label></td>
					<td><textarea rows="4" cols="36" autocorrect="off" autocapitalize="off" spellcheck="false" maxlength="128" style="overflow:hidden" width="250" name="description" placeholder="eg: Serve water to the runners during the marathon" form="eventCreator"></textarea></td>
                </tr>
				<tr>
					<td><label title = "Date when sign ups will be available">Release Date</label></td>
					<td><input name="releasedate" type="date" placeholder="eg: 01/01/2018" required></td>
				</tr>
                <tr>
					<td><label>Start Date :<span>*</span></label></td>
					<td><input name="startdate" type="date" id="startDate" placeholder="eg: 01/02/2018" required></td>
                </tr>
                <tr>
					<td><label>End Date :<span>*</span></label></td>
					<td><input name="enddate" onclick="autoCompleteDate()" id="endDate" type="date" placeholder="eg: 01/03/2018" required></td>
                </tr>
                <tr>
					<td><label>Location :<span>*</span></label></td>
					<td><input name="location" maxlength="32" type="text" placeholder="eg: George Washington Ave" required></td>
                </tr>
                <tr>
					<td><label>Shifts :<span>*</span></label></td>
					<td><input name="shifts" type="text" maxlength="2" placeholder="eg: 4 Shifts" required></td>
                </tr>
                <tr>
					<td></td>
					<td style = "text-align:center;"><input type="submit" value="Next" class = "classicColor"/></td>
                </tr>
            </table>
        </form>
    </div>

</div>