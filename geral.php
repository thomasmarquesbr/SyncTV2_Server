<div ng-controller="geralController">
<!--
  <accordion close-others="false">
    <accordion-group heading="Static Header, initially expanded">
      This content is straight in the template.
    </accordion-group>
    <accordion-group heading="{{group.title}}" ng-repeat="group in groups">
      {{group.content}}
    </accordion-group>
    <accordion-group is-open="status.open">
        <accordion-heading>
            I can have markup, too! <i class="pull-right glyphicon" ng-class="{'glyphicon-chevron-down': status.open, 'glyphicon-chevron-right': !status.open}"></i>
        </accordion-heading>
        This is just some content to illustrate fancy headings.
    </accordion-group>
  </accordion>
  -->

<accordion>
    <accordion-group ng-repeat="item in items" >
        <accordion-heading>{{item.Name}}</accordion-heading>
        {{item.City}}

            <accordion>
                <accordion-group ng-repeat="item in items" >
                    <accordion-heading>{{item.Name}}</accordion-heading>
                    {{item.City}}
                    
                </accordion-group>
            </accordion>

    </accordion-group>
</accordion>




<!--
  <accordion close-others="true">
      <accordion-group>
          <accordion-heading>item 1</accordion-heading>
              
              <accordion close-others="true">
                  <accordion-group>
                      <accordion-heading>item 1.1</accordion-heading>
                      content 1.1
                  </accordion-group>
                  <accordion-group>
                      <accordion-heading>item 1.2</accordion-heading>
                      content 1.2
                  </accordion-group>
              </accordion>
          
      </accordion-group>
      <accordion-group>
          <accordion-heading>item 2</accordion-heading>
              
              <accordion close-others="true">
                  <accordion-group>
                      <accordion-heading>item 2.1</accordion-heading>
                      content 2.1
                  </accordion-group>
                  <accordion-group>
                      <accordion-heading>item 2.2</accordion-heading>
                      content 2.2
                  </accordion-group>
                   <accordion-group>
                      <accordion-heading>item 2.3</accordion-heading>
                      content 2.3
                  </accordion-group>
              </accordion>
          
      </accordion-group>
  </accordion>
-->
</div>