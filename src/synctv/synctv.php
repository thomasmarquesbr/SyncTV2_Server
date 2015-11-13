<div ng-controller="synctvController">
<tabset class="tabs-left">
    <tab>
        <tab-heading><span class="glyphicon glyphicon-list-alt"></span> Geral </tab-heading>
        <div>
            <?php include('general/general.php'); ?>
        </div>
    </tab>
    <tab active="isActive">
        <tab-heading><span class="glyphicon glyphicon-th-list"></span> Canais </tab-heading>
         <div> 
            <?php include('channels/channels.php'); ?>
        </div>
    </tab>
    <tab>
        <tab-heading><span class="glyphicon glyphicon-calendar"></span> Programações </tab-heading>
        <div>
            <?php include('schedules/schedules.php'); ?>
        </div> 
    </tab>
    <tab>
        <tab-heading><span class="glyphicon glyphicon-facetime-video"></span> Multimídia </tab-heading>
        <div>
            <?php include('multimedia/multimedia.php'); ?>
        </div>
    </tab>
    <tab>
        <tab-heading><span class="glyphicon glyphicon-phone"></span> Aplicações </tab-heading>
        <div>
            <?php include('apps/applications.php'); ?>
        </div>
    </tab>
</tabset>
</div>