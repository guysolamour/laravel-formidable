<div x-data="formidable">


<h2 class="text-center">Création de formulaire</h2>
<form action="{{ route('back.formidable.store') }}" method="post" id="submitform" x-ref="submitform" class="d-none">
    @csrf
    <div class="form-group">
        <label for="fields">Fields</label>
        <input type="text" class="form-control" name="fields" id="fields" :value="JSON.stringify(data.form.fields)">
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" :value="data.form.title">
    </div>
    <div class="form-group">
        <label for="active">Active</label>
        <input type="text" class="form-control" name="active" id="active" :value="data.form.active">
    </div>
</form>
<hr>
<div class="form-group">
    <label for="first_title">Titre</label>
    <input type="text" id="first_title" class="form-control" x-model="data.form.title">
</div>
<div class="form-group" x-show="data.form.url">
    <label for="first_url" class="d-flex justify-content-between">
        <span>Url</span>
        <button class="btn btn-secondary btn-sm"><i class="fa fa-copy"></i> Copier  et partagez ce lien aux utilisateurs</button>
    </label>
    <input type="text" id="first_url" class="form-control" x-model="data.form.url" disabled>
</div>

<div class="row">
    <div class="col-md-12 mt-3">
        <p x-text="JSON.stringify(data.form.fields)"></p>
        <p x-text="JSON.stringify(orderedFields)"></p>

        <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item">
              <a @click.prevent="data.tab = 'build'" class="nav-link" :class="{ 'active': data.tab === 'build' }" href="#" role="tab">Build</a>
            </li>
            <li class="nav-item">
              <a @click.prevent="data.tab = 'settings'" class="nav-link" :class="{ 'active': data.tab === 'settings' }" href="#" role="tab">Settings</a>
            </li>
            <template x-if="data.edit_mode">
                <li class="nav-item">
                  <a @click.prevent="data.tab = 'entries'" class="nav-link" :class="{ 'active': data.tab === 'entries' }" role="tab">Entries</a>
                </li>
            </template>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade " :class="{ 'active show': data.tab === 'build' }"  role="tabpanel">
                <div class="row">
                    <div class="col-md-12 mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="my-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-tabs mb-3" role="tablist">
                                                <li class="nav-item">
                                                  <a class="nav-link" href="#" :class="{'active': data.add_tab == 'add'}" @click.prevent="data.add_tab = 'add'">Add fields</a>
                                                </li>
                                                <li class="nav-item" >
                                                  <a class="nav-link"  href="#" :class="{'active': data.add_tab == 'edit'}" @click.prevent="showFieldOptionsTab">Field options</a>
                                                </li>

                                              </ul>

                                              <div class="tab-content">
                                                <div class="tab-pane fade" :class="{ 'active show': data.add_tab === 'add' }" role="tabpanel">
                                                    <ul class="list-group border-none">
                                                        <template x-for="field in data.fields">
                                                            <li class="list-group-item">
                                                                <button class="btn btn-light btn-block text-left" @click.prevent="addField(field)">
                                                                    <i :class="field.icon"></i>&nbsp;&nbsp; <span x-text="field.type"></span>
                                                                </button>
                                                            </li>
                                                        </template>

                                                      </ul>
                                                </div>
                                                <div class="tab-pane fade" :class="{ 'active show': data.add_tab === 'edit' }" role="tabpanel">

                                                        <div class="accordion" id="accordionExample">
                                                            <div class="card">
                                                              <div class="card-header" id="headingOne">
                                                                <h5 class="mb-0">
                                                                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                    Content
                                                                  </button>
                                                                </h5>
                                                              </div>

                                                              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="">Label</label>
                                                                        <input type="text" class="form-control form-control-sm" x-model="data.form.current_field.label">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="">Name</label>
                                                                        <input type="text" class="form-control form-control-sm" x-model="data.form.current_field.name">
                                                                    </div>
                                                                    <div class="form-group" x-show="data.form.current_field.type != 'select'">
                                                                        <label for="">Placeholder</label>
                                                                        <input type="text" class="form-control form-control-sm" x-model="data.form.current_field.placeholder">
                                                                    </div>

                                                                    <div class="form-group" x-show="data.form.current_field.type != 'select'">
                                                                        <label for="">Default value</label>
                                                                        <input type="text" class="form-control form-control-sm" x-model="data.form.current_field.value">
                                                                    </div>


                                                                <div class="form-group" x-show="data.form.current_field.type == 'select'">
                                                                    <label for="">Options</label><br>

                                                                    <ul class="list-group mb-3">
                                                                        <template x-for="option in data.form.current_field.options">
                                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                                <span class="fz12" x-text="option.value + '|' + option.label"></span>
                                                                            <span>
                                                                                <span class="badge badge-info badge-pill cp"><i class="fa fa-edit"></i></span>
                                                                            <span class="badge badge-danger badge-pill cp" @click.prevent="removeSelectFieldOption(option)"><i class="fa fa-trash"></i></span>
                                                                            </span>
                                                                            </li>
                                                                        </template>


                                                                    </ul>
                                                                    <button x-show="!data.add_option" @click.prevent="data.add_option = true" class="btn btn-info btn-sm btn-block"><i class="fa fa-plus"></i> Ajouter une option</button>
                                                                    <div class="btn-group btn-group-sm mb-2 w-100" x-show="data.add_option">
                                                                        <button @click.prevent="cancelAddSelectFieldOption" class="btn btn-secondary"><i class="fa fa-times"></i> Annuler</button>
                                                                        <button  @click.prevent="addSelectFieldOption" class="btn btn-success"><i class="fa fa-save"></i> Enregistrer</button>
                                                                    </div>
                                                                    <textarea x-model="data.form.new_option" x-show="data.add_option" class="form-control form-control-sm" placeholder="La valeur et le label doivent etre separes avec le caractere | (pipe)"></textarea>

                                                                    </select>
                                                                </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="card">
                                                              <div class="card-header" id="headingTwo">
                                                                <h5 class="mb-0">
                                                                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    Style
                                                                  </button>
                                                                </h5>
                                                              </div>
                                                              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label for="">Class (css)</label>
                                                                        <input type="text" class="form-control form-control-sm" x-model="data.form.current_field.class">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Id (css)</label>
                                                                        <input  type="text" class="form-control form-control-sm" x-model="data.form.current_field.id">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Styles</label>
                                                                        <textarea name="" id="" cols="30" rows="5" class="form-control form-control-sm" x-model="data.form.current_field.style"></textarea>
                                                                        <small id="emailHelp" class="form-text text-muted font-italic fz12">
                                                                            Mofifiez directement ce champ lorsque vous avez des connaissances en programmation.
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="card">
                                                              <div class="card-header" id="headingThree">
                                                                <h5 class="mb-0">
                                                                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                    Attributes
                                                                  </button>
                                                                </h5>
                                                              </div>
                                                              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                                <div class="card-body">
                                                                    <div class="form-group" x-show="data.form.current_field.type == 'select'">
                                                                        <label for="">Multiple</label>
                                                                        <select class="form-control form-control-sm" x-model="data.form.current_field.multiple">
                                                                            <option value="0">false</option>
                                                                            <option value="1">true</option>

                                                                        </select>
                                                                    </div>




                                                                    <div class="form-group">
                                                                        <label for="">Rules</label>
                                                                        <p>
                                                                            <template x-for="rule in data.form.current_field.rules">
                                                                                <span class="badge badge-pill badge-info" x-text="getRuleLabel(rule)"></span>
                                                                            </template>

                                                                        </p>
                                                                        <select @change="selectFieldRule" name="" id="" class="form-control form-control-sm">
                                                                            <option value="0">Choisir une regle</option>

                                                                            <template x-for="rule in data.rules">
                                                                                <option :value="rule.name" x-text="rule.label || rule.name"></option>
                                                                            </template>
                                                                        </select>

                                                                        <div class="form-group" x-show="data.form.current_rule.hasOwnProperty('arg')">
                                                                            <label for="arguments" class="fz12">Arguments regle <b class="text-success font-italic" x-text="data.form.current_rule.label"></b></label>
                                                                            <input x-model="data.form.current_rule.arg" type="text" id="arguments" :placeholder="data.form.current_rule.hint" class="form-control form-control-sm">
                                                                            <button :disabled="!data.form.current_rule.arg" @click.prevent="setCurrentRuleArg" class="mt-1 btn btn-secondary btn-sm btn-block"><i class="fa fa-plus"></i> Ajouter</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>








                                                </div>
                                              </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group my-2">
                                    <div class="card" x-show="orderedFields.length">
                                        <div class="card-body" >
                                            <template x-for="field in orderedFields" :key="field.key">
                                                <div>
                                                    <template x-if="field.type === 'text' || field.type === 'number' || field.type === 'email' || field.type == 'date' || field.type == 'url'">
                                                        <div class="form-group" :class="{'field-highlited': field.key === data.form.current_field.key}">
                                                                <label for="" class="d-flex justify-content-between">
                                                                    <span x-text="field.label"></span>
                                                                    <div class="btn-group">
                                                                        <button
                                                                            x-show="data.form.current_field.key != field.key" @click.prevent="selectField(field)" class="btn btn-success btn-sm" title="Selectionner">
                                                                            <i class="fa fa-check"></i>
                                                                        </button>
                                                                        <button
                                                                            x-show="data.form.current_field.key == field.key" @click.prevent="unSelectField(field)" class="btn btn-info btn-sm" title="Deselectionner">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                        <button class="btn btn-danger btn-sm" @click.prevent="removeField(field)" title="Retirer"><i class="fa fa-trash"></i> </button>

                                                                        <button x-show="field.order != data.form.fields.length" @click.prevent="downField(field)" class="btn btn-info btn-sm" title="Avancer"><i class="fa fa-arrow-down"></i> </button>
                                                                        <button x-show="field.order != 1 && data.form.fields.length != 1" @click.prevent="upField(field)" class="btn btn-primary btn-sm" title="Reculer"><i class="fa fa-arrow-up"></i> </button>
                                                                        <button @click.prevent="duplicateField(field)" class="btn btn-secondary btn-sm" title="Dupliquer"><i class="fa fa-copy"></i> </button>
                                                                    </div>
                                                                </label>
                                                                <input
                                                                    :type="field.type" :name="field.name" :id="field.id" :value="field.value" :placeholder="field.placeholder" :class="field.class"
                                                                    :style="field.style"
                                                                    >
                                                        </div>
                                                    </template>
                                                    <template x-if="field.type === 'textarea'">
                                                        <div class="form-group" :class="{'field-highlited': field.key === data.form.current_field.key}">
                                                                <label for="" class="d-flex justify-content-between">
                                                                    <span x-text="field.label"></span>
                                                                    <div class="btn-group">
                                                                        <button
                                                                            x-show="data.form.current_field.key != field.key" @click.prevent="selectField(field)" class="btn btn-success btn-sm" title="Selectionner">
                                                                            <i class="fa fa-check"></i>
                                                                        </button>
                                                                        <button
                                                                            x-show="data.form.current_field.key == field.key" @click.prevent="unSelectField(field)" class="btn btn-info btn-sm" title="Deselectionner">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                        <button class="btn btn-danger btn-sm" @click.prevent="removeField(field)" title="Retirer"><i class="fa fa-trash"></i> </button>

                                                                        <button x-show="field.order != data.form.fields.length" @click.prevent="downField(field)" class="btn btn-info btn-sm" title="Avancer"><i class="fa fa-arrow-down"></i> </button>
                                                                        <button x-show="field.order != 1 && data.form.fields.length != 1" @click.prevent="upField(field)" class="btn btn-primary btn-sm" title="Reculer"><i class="fa fa-arrow-up"></i> </button>
                                                                        <button @click.prevent="duplicateField(field)" class="btn btn-secondary btn-sm" title="Dupliquer"><i class="fa fa-copy"></i> </button>
                                                                    </div>
                                                                </label>
                                                                <textarea
                                                                    :name="field.name" :id="field.id" :class="field.class" :value="field.value" :placeholder="field.placeholder"
                                                                    :cols="field.cols" :rows="field.rows"
                                                                    >

                                                                    ></textarea>
                                                        </div>
                                                    </template>
                                                    <template x-if="field.type === 'select'">
                                                        <div class="form-group" :class="{'field-highlited': field.key === data.form.current_field.key}">
                                                                <label for="" class="d-flex justify-content-between">
                                                                    <span x-text="field.label"></span>
                                                                    <div class="btn-group">
                                                                        <button
                                                                            x-show="data.form.current_field.key != field.key" @click.prevent="selectField(field)" class="btn btn-success btn-sm" title="Selectionner">
                                                                            <i class="fa fa-check"></i>
                                                                        </button>
                                                                        <button
                                                                            x-show="data.form.current_field.key == field.key" @click.prevent="unSelectField(field)" class="btn btn-info btn-sm" title="Deselectionner">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                        <button class="btn btn-danger btn-sm" @click.prevent="removeField(field)" title="Retirer"><i class="fa fa-trash"></i> </button>

                                                                        <button x-show="field.order != data.form.fields.length" @click.prevent="downField(field)" class="btn btn-info btn-sm" title="Avancer"><i class="fa fa-arrow-down"></i> </button>
                                                                        <button x-show="field.order != 1 || data.form.fields.length != 1" @click.prevent="upField(field)" class="btn btn-primary btn-sm" title="Reculer"><i class="fa fa-arrow-up"></i> </button>
                                                                        <button @click.prevent="duplicateField(field)" class="btn btn-secondary btn-sm" title="Dupliquer"><i class="fa fa-copy"></i> </button>
                                                                    </div>
                                                                </label>
                                                                <select :name="field.name" :id="field.id" :class="field.class" :multiple="field.multiple == 1">
                                                                    <template x-for="option in field.options">
                                                                        <option :value="option.value" x-text="option.label"></option>
                                                                    </template>
                                                                </select>

                                                        </div>
                                                    </template>

                                                    <template x-if="field.type === 'submit'">
                                                        <div class="form-group">

                                                                <button :type="field.type" x-text="field.label" :class="field.class"></button>
                                                        </div>
                                                    </template>
                                                </div>
                                            </template>
                                        </div>
                                      </div>
                                    <p  x class="text-center" x-show="!orderedFields.length">
                                        Le forumulaire est vide. Ajoutez des champs
                                    </p>
                                </div>
                            </div>
                           </div>
                           <div class="col-md-12">
                            <button @click.prevent="handleSubmit" :disabled="data.form.fields.length == 0" class="btn btn-block btn-success">Enregistrer</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" :class="{ 'active show': data.tab === 'settings' }"  role="tabpanel">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" id="title" x-model="data.form.title">
                </div>
                <div class="form-group" x-show="data.form.url">
                    <label for="url" class="d-flex justify-content-between">
                        <span>Url</span>
                        <button class="btn btn-secondary btn-sm"><i class="fa fa-copy"></i> Copier  et partagez ce lien aux utilisateurs</button>
                    </label>
                    <input type="text" id="url" class="form-control" x-model="data.form.url" disabled>
                </div>
                <div class="form-group" x-show="data.form.short_code">
                    <label for="short_code">Short Code</label>
                    <input type="text" id="short_code" class="form-control" x-model="data.form.short_code" disabled>
                </div>
                <div class="form-group">
                    <label for="active">Active</label>
                    <select name="active" id="active" class="form-control" x-model="data.form.active">
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                    </select>
                </div>

            </div>
            <template x-if="data.edit_mode">
            <div class="tab-pane fade" :class="{ 'active show': data.tab === 'entries' }" role="tabpanel">
                <table class="table table-striped mt-4">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
            </template>
          </div>
    </div>

</div>

</div>


@push('js')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('formidable', () => ({
            data: {
                tab: 'build',
                add_tab: 'add',
                add_option: false,
                submitform: null,
                edit_mode: @json($edit ?? false),
                model: @json($form ?? null),
                form: {
                    title: "",
                    new_option: "",
                    active: 1,
                    url: '',
                    short_code: '',
                    current_field: {
                        key: null,
                    },
                    current_rule: {},

                    fields: []
                },
                fields: [
                    {
                        type: "text",
                        icon: "fa fa-edit"
                    },
                    {
                        type: "textarea",
                        icon: "fa fa-edit"
                    },
                    {
                        type: "email",
                        icon: "fa fa-envelope"
                    },
                    {
                        type: "number",
                        icon: "fa fa-phone"
                    },
                    {
                        type: "date",
                        icon: "fa fa-calendar"
                    },
                    {
                        type: "url",
                        icon: "fa fa-link"
                    },
                    // {
                    //     type: "file",
                    //     icon: "fa fa-file"
                    // },
                    {
                        type: "select",
                        icon: "fa fa-bars"
                    },
                    // {
                    //     type: "checkbox",
                    //     icon: "fa fa-check"
                    // },
                    {
                        type: "submit",
                        icon: "fa fa-save"
                    },
                ],
                rules: [
                    { name: "required", label: "obligatoire" },
                    { name: "min", arg: "", label: "minimum" },
                    { name: "minLength", arg: "", label: "Taille minimum", hint: "5" },
                    { name: "maxLength", arg: "5" , label: "Taille maximum", hint: "5"},
                    { name: "max", arg: "", label: "maximum", hint: "10" },
                    { name: "email" },
                    { name: "numeric", label: "numerique" },
                    { name: "string", label: "texte" },
                    { name: "email" },
                    { name: "between", arg: "", label: "entre", hint: "10,20"},
                    { name: "file", label: "fichier" },
                    { name: "image" },
                    { name: "in", arg: "", label: "dans", hint: "foo,bar"},
                    { name: "url" },
                    { name: "regex", arg: "", label: "expression reguliere", hint: "\d{4,4}" },
                    // "required", "min:5", "pattern", "email", "max:5", "minLength", "maxLength",
                    // "alpha", "numeric", "between:min,max", "file", "image", "in:foo,bar", "not_in:foo,bar",
                    // "regex:patern",
                    // "url",
                ]
            },
            init(){
                

                if (this.data.edit_mode && this.data.model){
                    this.data.form.title = this.data.model.title
                    this.data.form.active = this.data.model.active
                    this.data.form.url = this.data.model.full_url
                   

                    this.data.model.fields.forEach(item => {
                        this.data.form.fields.push({
                            ...item,
                            class: item.class || item.className,
                        custom_attributes: item.customAttributes,
                        })
                    });

                    console.log(this.data.model.fields);
                }



                this.submitform = document.getElementById('submitform');
            },
            get lastAddedRule(){
                if (this.data.form.current_field) return {}

                const rules = this.data.form.current_field.rules

                if (rules.length == 0) return {}

                return rules[rules.length - 1];
            },
            get orderedFields(){
                return  this.data.form.fields.sort((a,b) => {
                    if ( a.order < b.order ){
                        return -1;
                    }
                        
                    if ( a.order > b.order ){
                        return 1;
                    }
                    
                    return 0;
                })
            },
            get isEmptyCurrentField(){
                return Object.keys(this.data.form.current_field).length === 0
            },
            cancelAddSelectFieldOption(){
                this.data.add_option = false
                this.data.form.new_option = ''
            },
            addSelectFieldOption(){
                const new_option = this.data.form.new_option

                let value = new_option.toLowerCase()
                let label = new_option

                if (new_option.includes("|")){
                    [value, label] = new_option.split("|")
                }

                this.data.form.current_field.options.push({
                    id: this.randomId(),
                    value,
                    label
                })

                this.cancelAddSelectFieldOption()
            },
            showFieldOptionsTab(){
                if (this.data.form.fields.length == 0){
                    return
                }

                this.data.add_tab = 'edit'
            },
            randomId(){
                return Math.ceil(Math.random() * 10000)
            },
            addField(field){
                this.resetAddFieldTab()
                const data = {
                    key: Date.now(),
                    order: this.data.form.fields.length + 1,
                    name: field.type.toLowerCase(),
                    type: field.type,
                    label: field.type,
                    class: "form-control",
                    id: field.type.toLowerCase(),
                    value: "",
                    custom_attributes: "",
                    // placeholder: "",
                    rules: [],
                    // options: [],
                    style: "",
                }

                if (field.type == 'text' || field.type == 'email' || field.type == 'number'){
                    data.placeholder = "placeholder"
                }

                if (field.type == 'select'){
                    data.multiple = 0
                    data.options = [
                        { id: this.randomId(), value: "value1", label: "Value1"},
                        { id: this.randomId(), value: "value2", label: "Value2"},
                    ]
                }

                if (field.type == 'email'){
                    data.rules.push(this.getRuleByName('email'))
                }

                // si c'est un champ de type emial ajouter la regle email

                this.data.form.fields.push(data)

                this.selectField(data)
            },
            getRuleByName(name){
                return this.data.rules.find(item => item.name == name) || {}
            },
            getRuleLabel(rule){
                let label = rule.label || rule.name

                if (rule.hasOwnProperty('arg')) {
                    label =  `${label}:${rule.arg}`
                }
                return label
            },
            setCurrentRuleArg(){
                const current_rule = this.data.form.current_rule

                if (!current_rule.arg){
                    alert("L'argument est obligatoire")
                    return
                }

                const rule = this.getRuleByName(current_rule.name)

                rule.arg = current_rule.arg
                rule.full_label = "fullLabel";

                this.data.form.current_field.rules.push(rule)

                this.data.form.current_rule = {}
            },
            selectFieldRule(event){
                
                const rule = this.getRuleByName(event.target.value)

                this.data.form.current_rule = {...rule} // permet de cloner un objet et important

                if (!rule.hasOwnProperty('arg')){
                    this.data.form.current_field.rules.push(rule)
                }
                event.target.value = 0 // permet de reinitialiser le formulaire puisquon n'a pas de x-model
            },
            selectField(field){
                this.data.form.current_field = field
                this.data.add_tab = 'edit'
            },
            unSelectField(field){
                this.data.form.current_field = {}
                this.data.add_tab = 'add'
            },
            resetAddFieldTab(){
                // reset rules form
                return this.unSelectField()
            },
            removeSelectFieldOption(option){
                this.data.form.current_field.options = this.data.form.current_field.options.filter(item => item.id != option.id)
            },
            removeField(field){
                if (!confirm("Etes vous sur de bien vouloir retirer ce champ")) return

                this.data.form.fields = this.data.form.fields.filter(item => item.key != field.key)

                // remetre les orders en l'etat
                this.data.form.fields.forEach((item, index) => item.order = index + 1)

                // si plus de donnes dans les champs retirer le curent field et passer a addd
                if (this.data.form.fields.length == 0){
                    this.resetAddFieldTab()
                }
            },
            duplicateField(field){
                // tres important les ... permettent de cloner l'objet et eviter les references
                this.addField({...field})
            },
            downField(field){
                // on flip l'order du champ actuel avec le champ suivant
                this.upOrDownField(field)
            },
            upField(field){
                this.upOrDownField(field, false)
            },
            upOrDownField(field, down = true){
                const current_order = field.order
                
                const nex_or_prev_field =  this.data.form.fields.find(function(item){

                    if (down){
                        return item.order == current_order + 1
                    }

                    return item.order == current_order - 1
                })


                field.order = down ? current_order + 1 :current_order - 1

                nex_or_prev_field.order = current_order
            },
            handleSubmit(){
                // verifier si un champ input submit est present avant de soummettre
                this.submitform.submit()
            },
        }))
    })
</script>
@endpush

@push('css')
<style>
    .field-highlited {
        background-color: lightsteelblue;
    }
    .cp {
        cursor: pointer;
    }
    .fz12 {
        font-size: .85rem;
    }
</style>
@endpush
