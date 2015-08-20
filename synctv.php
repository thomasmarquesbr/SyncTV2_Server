<tabset class="tabs-left">
    <tab>
        <tab-heading><span class="glyphicon glyphicon-list-alt"></span> Geral </tab-heading>
        <div>
            <?php include('geral.php'); ?>
        </div>
    </tab>
    <tab>
        <tab-heading><span class="glyphicon glyphicon-th-list"></span> Canais </tab-heading>
         <div> 
            <?php include('channels.php'); ?>
        </div>
    </tab>
    <tab>
        <tab-heading><span class="glyphicon glyphicon-calendar"></span> Programações </tab-heading>
        <div>
            <?php include('schedules.php'); ?>
        </div> 
    </tab>
    <tab>
        <tab-heading><span class="glyphicon glyphicon-facetime-video"></span> Multimídia </tab-heading>
        <div>
            <?php include('multimedia.php'); ?>
        </div>
    </tab>
    <tab>
        <tab-heading><span class="glyphicon glyphicon-phone"></span> Aplicações </tab-heading>
        <div>
            <?php include('applications.php'); ?>
        </div>
    </tab>
</tabset>