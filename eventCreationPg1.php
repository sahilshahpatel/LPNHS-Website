<div class="container">
    <div class="main">
        <h2>PHP Multi Page Form</h2>
        <span id="error">

        </span>
        <form id="eventCreator" action="eventCreationPg2.php" method="post">
            <label>Event Name :<span>*</span></label>
            <input name="name" type="text" placeholder="eg: Winter Marathon" required>
            <label>Description :</label>
            <input name="description" type="text" placeholder="eg: Serve water to the runners during the marathon">
            <label>Start Date :<span>*</span></label>
            <input name="startdate" type="date" placeholder="eg: 01/01/2018" required>
            <label>End Date :<span>*</span></label>
            <input name="enddate" type="date" placeholder="eg: 01/02/2018" required>
            <label>Location :<span>*</span></label>
            <input name="location" type="text" placeholder="eg: George Washington Ave" required>
            <label>Shifts :<span>*</span></label>
            <input name="shifts" type="text" placeholder="eg: 4 Shifts" required>
            <input type="submit" value="Next" />
        </form>
    </div>
</div>