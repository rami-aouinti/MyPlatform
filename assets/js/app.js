import '../styles/app.scss';
import $ from 'jquery';
import 'popper.js';
import moment from 'moment';
import Vue from 'vue';
import App from './components/App';

const app = new Vue({
    el: '#app',
    render: h => h(App)
});

moment.locale("en_EN");
if ($("#formations").length > 0) {
    $.getJSON("/api/formations", formations => {
        formations.forEach(formation => {
            $("#formations").append(`

                <li class="timeline-inverted">
                    <div class="timeline-badge warning">
                        <i class="material-icons">card_travel</i>
                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <span class="badge badge-pill badge-warning">
                             ${moment(formation.startedAt).format("YYYY")} - ${formation.endedAt === null ? "Today" : moment(formation.endedAt).format("YYYY")}
                            </span>
                        </div>
                        <div class="timeline-body">
                        <p>${formation.name}</p>
                            <span class="text-muted">${formation.school} - BAC+${formation.gradeLevel}</span>
                        <p>${formation.description}</p>
                        </div>
                        <h6>
                            <i class="ti-time"></i> 11 hours ago via Twitter
                        </h6>
                    </div>
                </li>
            `);
        });
    })
}

if ($("#skills").length > 0) {
    $.getJSON("/api/skills", skills => {
        skills.forEach(skill => {
            var stars = '';
            for (var i= 0; i <10; i++) {
                if ( i < skill.level) {
                    stars = stars + '<span class="material-icons">' + 'star' + '</span>'
                } else {
                    stars = stars + '<span class="material-icons">' + 'star_border' + '</span>'
                }
            }
            $("#skills").append(`
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3"><h4>${skill.name}</h4></div>
                    <div class="col-md-8">${stars}</div>
                </div>
            `);
        });
    })
}

if ($("#languages").length > 0) {
    $.getJSON("/api/languages", languages => {
        languages.forEach(language => {
            var stars = '';
            for (var i= 0; i <10; i++) {
                if ( i < language.level) {
                    stars = stars + '<span class="material-icons">' + 'star' + '</span>'
                } else {
                    stars = stars + '<span class="material-icons">' + 'star_border' + '</span>'
                }
            }
            $("#languages").append(`
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-3"><h4>${language.name}</h4></div>
                    <div class="col-md-8">${stars}</div>
                </div>
            `);
        });
    })
}

if ($("#hobbies").length > 0) {
    $.getJSON("/api/hobbies", hobbies => {
        hobbies.forEach(hobby => {
            $("#hobbies").append(`
                <li class="list-group-item">${hobby.name}</li>
            `);
        });
    })
}

if ($("#projects").length > 0) {
    $.getJSON("/api/projects", projects => {
        projects.forEach(project => {
            $("#projects").append(`
                <li class="list-group-item">${project.name}</li>
            `);
        });
    })
}

if ($("#attributes").length > 0) {
    $.getJSON("/api/hobbies", attributes => {
        attributes.forEach(attribute => {
            $("#attributes").append(`
                <li class="list-group-item">${attribute.name}</li>
            `);
        });
    })
}

if ($("#references").length > 0) {
    $.getJSON("/api/references", references => {
        references.forEach(reference => {
            $("#references").append(`
                <div class="col-md-6">
                    <div class="card card-product">
                        <div class="card-header card-header-image" data-header-animation="true">
                            <a href="#pablo">
                               <img class="img" src="../assets/admin/assets/img/card-2.jpg">
                            </a>
                        </div>
                    <div class="card-body">
                    <div class="card-actions text-center">
                      <button type="button" class="btn btn-danger btn-link fix-broken-card">
                        <i class="material-icons">build</i> Fix Header!
                      </button>
                      <button type="button" class="btn btn-default btn-link" rel="tooltip" data-placement="bottom" title="View">
                        <i class="material-icons">art_track</i>
                      </button>
                      <button type="button" class="btn btn-success btn-link" rel="tooltip" data-placement="bottom" title="Edit">
                        <i class="material-icons">edit</i>
                      </button>
                      <button type="button" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="Remove">
                        <i class="material-icons">close</i>
                      </button>
                    </div>
                    <h4 class="card-title">
                      <a href="#pablo">${reference.title}</a>
                    </h4>
                    <div class="card-description">
                      ${reference.description}
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="price">
                      <h6>${reference.company} - ${moment(reference.startedAt).format("YYYY")} - ${reference.endedAt === null ? "Today" : moment(reference.endedAt).format("YYYY")}t</h6>
                    </div>
                    <div class="stats">
                      <p class="card-category"><i class="material-icons">place</i> Barcelona, Spain</p>
                    </div>
                  </div>
                </div>
                </div>
            `);
        });
    })
}


$("body").on("click", ".collection-item-delete", e => {
    $(e.currentTarget).closest("div").remove();
});

$("body").on("click", ".collection-add", e => {
    let collection = $(`#${e.currentTarget.dataset.collection}`);
    let prototype = collection.data('prototype');
    let index = collection.data('index');
    collection.append(prototype.replace(/__name__/g, index));
    collection.data('index', index++);
})