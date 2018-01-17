<div class="container">
    <div class="main">
        <h2 style = "font-size:32px;text-align:center;">Event Creation Page</h2>
        <span id="error">
        </span>
        <form id="eventCreator" action="eventCreationPg2.php" method="post">
            <table style="width=100%;" class = "listing">
                <tr>
                    <td><label>Event Name :<span>*</span></label></td>
                    <td><input name="name" type="text" placeholder="eg: Winter Marathon" required></td>
                </tr>
                <tr>
                <td><label>Description :</label></td>
                <td><input name="description" type="text" placeholder="eg: Serve water to the runners during the marathon"></td>
                </tr>
                <tr>
                <td><label>Start Date :<span>*</span></label></td>
                <td><input name="startdate" type="date" placeholder="eg: 01/01/2018" required></td>
                </tr>
                <tr>
                <td><label>End Date :<span>*</span></label></td>
                <td><input name="enddate" type="date" placeholder="eg: 01/02/2018" required></td>
                </tr>
                <tr>
                <td><label>Location :<span>*</span></label></td>
                <td><input name="location" type="text" placeholder="eg: George Washington Ave" required></td>
                </tr>
                <tr>
                <td><label>Shifts :<span>*</span></label></td>
                <td><input name="shifts" type="text" placeholder="eg: 4 Shifts" required></td>
                </tr>
                <tr>
                <td></td>
                <td style = "text-align:center;"><input type="submit" value="Next" class = "classicColor"/></td>
                </tr>
            </table>
        </form>
    </div>
</div>