


<li class="§-item list-group-item">
  <table class="w-100">
    <tr>
      <td>Beschriftung</td>
      <td><input data-name="label"/></td>
      <td><div class="btn btn-danger float-right §-remove"><i class=" fa fa-remove"></i></div></td>
    </tr>
    <tr><td>Typ</td>
      <td>
        <select class="§-type" data-name="type">
          <option value="text">Text</option>
          <option value="textarea">Langer Text</option>
          <option value="email">E-Mail</option>
          <option value="date">Datum</option>
          <option value="checkbox">Checkbox</option>
          <option value="select">Auswahl</option>
          <!--option value="multiselect">Mehrfach - Auswahl</option-->
        </select>
      </td>
    </tr>
    <tr class="§-options"><td>Optionen</td>
      <td>
        mit "," getrennt<br/>
        <input  data-name="options"/>
      </td>
    </tr>
    <tr><td>Pflichtfeld</td>
      <td>
        <input data-name="mandatory" type="checkbox"/>
      </td>
    </tr>
  </table>
  <input data-name="id" type="hidden"/>
</li>