(() => {
    var e, t = {
        357: () => {
            !function (e) {
                "use strict";
                var t = e("#contactForm"), o = e("#sendMessage");
                t.length && o.on("click", (function (n) {
                    n.preventDefault();
                    var i = t.serializeArray(), a = getConfig.baseURL + "/contact-us/send";
                    o.prop("disabled", !0), e.ajax({
                        headers: {"X-CSRF-TOKEN": e('meta[name="csrf-token"]').attr("content")},
                        url: a,
                        type: "POST",
                        data: i,
                        dataType: "json",
                        beforeSend: function () {
                            e("body").LoadingOverlay("show")
                        }
                    }).done((function (n) {
                        e("body").LoadingOverlay("hide"), o.prop("disabled", !1), e.isEmptyObject(n.error) ? (t.trigger("reset"), window.grecaptcha && grecaptcha.reset(), toastr.success(n.success)) : toastr.error(n.error)
                    })).fail((function (t, o, n) {
                        e("body").LoadingOverlay("hide"), toastr.error(n)
                    }))
                }));
                var n = e("#uploads-chart");
                if (n.length) {
                    var i = {
                        initUploads: function () {
                            this.uploadsChartsData()
                        }, uploadsChartsData: function () {
                            var t = getConfig.baseURL + "/user/dashboard/charts/uploads";
                            e.ajax({method: "GET", url: t}).done((function (e) {
                                i.createUploadsCharts(e)
                            }))
                        }, createUploadsCharts: function (e) {
                            var t = e.suggestedMax, o = e.uploadsChartLabels, i = e.uploadsChartData;
                            window.Chart && new Chart(n, {
                                type: "bar",
                                data: {
                                    labels: o,
                                    datasets: [{
                                        label: "Uploads",
                                        data: i,
                                        fill: !0,
                                        tension: .3,
                                        backgroundColor: getConfig.primaryColor,
                                        borderColor: getConfig.primaryColor
                                    }]
                                },
                                options: {
                                    responsive: !0,
                                    maintainAspectRatio: !1,
                                    plugins: {legend: {display: !1}},
                                    scales: {y: {suggestedMax: t}}
                                }
                            }).render()
                        }
                    };
                    i.initUploads()
                }
            }(jQuery)
        }, 124: (e, t, o) => {
            o(892), o(219), o(357), o(291), o(454), o(346), o(598)
        }, 454: () => {
            function e(e) {
                return function (e) {
                    if (Array.isArray(e)) return t(e)
                }(e) || function (e) {
                    if ("undefined" != typeof Symbol && null != e[Symbol.iterator] || null != e["@@iterator"]) return Array.from(e)
                }(e) || function (e, o) {
                    if (!e) return;
                    if ("string" == typeof e) return t(e, o);
                    var n = Object.prototype.toString.call(e).slice(8, -1);
                    "Object" === n && e.constructor && (n = e.constructor.name);
                    if ("Map" === n || "Set" === n) return Array.from(e);
                    if ("Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return t(e, o)
                }(e) || function () {
                    throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")
                }()
            }

            function t(e, t) {
                (null == t || t > e.length) && (t = e.length);
                for (var o = 0, n = new Array(t); o < t; o++) n[o] = e[o];
                return n
            }

            !function (t) {
                "use strict";
                var o = t(".search"), n = t(".search .search-input input"), i = document.querySelector(".search-btn"),
                    a = document.querySelector(".search-close");
                i && (i.onclick = function () {
                    o.addClass("active")
                }), a && (a.onclick = function () {
                    o.removeClass("active"), o.removeClass("show"), n.val("")
                });
                var r = document.querySelector(".dash"), l = document.querySelector(".dash-sidebar-btn"),
                    s = document.querySelector(".dash-sidebar .overlay");
                r && (s.onclick = l.onclick = function () {
                    r.classList.toggle("toggle")
                }, window.addEventListener("resize", (function () {
                    r.classList.remove("toggle")
                })));
                var c = document.querySelectorAll(".filemanager-file"),
                    d = document.querySelector(".filemanager-actions"),
                    u = document.querySelector(".filemanager-select-all"), f = [];
                c && c.forEach((function (t) {
                    var o = t.querySelector(".form-check-input"), n = t.querySelectorAll(".filemanager-link"),
                        i = t.querySelector(".dropdown");

                    function a() {
                        var t = document.querySelectorAll(".filemanager-file.selected");
                        t.length > 0 ? d.classList.add("show") : d.classList.remove("show"), t.length === c.length ? (u.checked = !0, u.nextElementSibling.textContent = u.parentNode.getAttribute("data-unselect")) : (u.checked = !1, u.nextElementSibling.textContent = u.parentNode.getAttribute("data-select")), c.forEach((function (t) {
                            if (!0 === t.querySelector(".form-check-input").checked) {
                                f.push(t.querySelector(".form-check-input").id);
                                var o = e(new Set(f));
                                filesSelectedInput.value = o.sort()
                            } else {
                                f = f.filter((function (e) {
                                    return e !== t.querySelector(".form-check-input").id
                                }));
                                var n = e(new Set(f));
                                filesSelectedInput.value = n
                            }
                        }))
                    }

                    o.onchange = function () {
                        !0 === o.checked ? (t.classList.add("selected"), o.checked) : (t.classList.remove("selected"), o.checked), a()
                    }, t.onclick = function () {
                        !0 === o.checked ? (o.checked = !1, t.classList.remove("selected"), o.checked) : (o.checked = !0, t.classList.add("selected"), o.checked), a()
                    }, i.onclick = function () {
                        !0 === o.checked ? (o.checked = !1, t.classList.remove("selected"), o.checked) : (o.checked = !0, t.classList.add("selected"), o.checked)
                    }, o.onclick = function (e) {
                        e.stopPropagation()
                    }, n && n.forEach((function (e) {
                        e.onclick = function (e) {
                            e.stopPropagation()
                        }
                    })), u.onchange = function () {
                        !0 === u.checked ? c.forEach((function (e) {
                            e.querySelector(".form-check-input").checked = !0, e.classList.add("selected"), o.checked
                        })) : c.forEach((function (e) {
                            e.querySelector(".form-check-input").checked = !1, d.classList.remove("show"), e.classList.remove("selected"), o.checked
                        })), a()
                    }
                }));
                var p = t("#change_avatar"), h = t("#avatar_preview");
                p.on("change", (function () {
                    (function (e) {
                        if (e.files && e.files[0]) {
                            var t = new FileReader;
                            t.onload = function (e) {
                                h.attr("src", e.target.result)
                            }, t.readAsDataURL(e.files[0])
                        }
                    })(this)
                }));
                var m = t(".fileManager-share-file"), v = t("#shareModal"), g = t(".share-modal .share"),
                    w = t(".share-modal #copy-preview-link"), y = t(".share-modal #copy-download-link"),
                    b = t(".share-modal .preview-link"), C = t(".share-modal .filename");
                m.length && m.on("click", (function (e) {
                    e.preventDefault();
                    var o = t(this).data("share"), n = t(this).data("preview"),
                        i = "https://www.facebook.com/sharer/sharer.php?u=" + o.download_link,
                        a = "https://twitter.com/intent/tweet?text=" + o.download_link,
                        r = "https://wa.me/?text=" + o.download_link,
                        l = "https://www.linkedin.com/shareArticle?mini=true&url=" + o.download_link,
                        s = "http://pinterest.com/pin/create/button/?url=" + o.download_link;
                    C.html("<strong>" + o.filename + "</strong>"), g.html('<a href="' + i + '" target="_blank" class="bg-facebook"><i class="fab fa-facebook-f"></i></a> <a href="' + a + '" target="_blank" class="bg-twitter"><i class="fab fa-twitter"></i></a> <a href="' + r + '" target="_blank" class="bg-whatsapp"><i class="fab fa-whatsapp"></i></a> <a href="' + l + '" target="_blank" class="bg-linkedin"><i class="fab fa-linkedin"></i></a> <a href="' + s + '" target="_blank" class="bg-pinterest"><i class="fab fa-pinterest"></i></a>'), 1 == n ? (b.removeClass("d-none"), w.attr("value", o.preview_link)) : b.addClass("d-none"), y.attr("value", o.download_link), v.modal("show")
                }))
            }(jQuery)
        }, 892: () => {
        }, 291: () => {
            !function (e) {
                "use strict";
                var t = document.querySelector(".uploadbox"), o = document.querySelectorAll("[data-upload-btn]");
                if (t) {
                    var n = function () {
                        var t = e(".uploadbox"), o = e(".uploadbox-drag"), n = e(".uploadbox-wrapper");
                        u.files.length > 0 ? (o.addClass("inactive"), n.addClass("active"), e("body").addClass("overflow-hidden"), v.removeClass("d-none"), t.addClass("active"), f.removeClass("d-none")) : (o.removeClass("inactive"), n.removeClass("active"), v.addClass("d-none"), h.prop("disabled", !1), p.removeClass("d-none"), f.addClass("d-none"))
                    }, i = function (e) {
                        var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : 2;
                        if (0 === e) return "0 " + getUploadConfig.translation.formatSizes[0];
                        var o = 1024, n = t < 0 ? 0 : t, i = getUploadConfig.translation.formatSizes,
                            a = Math.floor(Math.log(e) / Math.log(o));
                        return parseFloat((e / Math.pow(o, a)).toFixed(n)) + " " + i[a]
                    }, a = function (e) {
                        return e.split(".").pop()
                    }, r = function () {
                        var e = document.querySelectorAll(".btn-copy");
                        e && e.forEach((function (e) {
                            new ClipboardJS(e).on("success", (function () {
                                toastr.success(getConfig.copiedToClipboardSuccess)
                            }))
                        }))
                    };
                    o.forEach((function (e) {
                        e.onclick = function () {
                            t.classList.add("active"), document.body.classList.add("overflow-hidden")
                        }
                    })), t.querySelector(".btn-close").onclick = function () {
                        u.getQueuedFiles().length > 0 || u.getUploadingFiles().length > 0 ? confirm(getUploadConfig.closeUploadBoxAlert) && (u.removeAllFiles(!0), t.classList.remove("active"), document.body.classList.remove("overflow-hidden")) : (u.removeAllFiles(!0), t.classList.remove("active"), document.body.classList.remove("overflow-hidden"))
                    };
                    var l = getConfig.baseURL + "/upload", s = document.querySelector("#upload-previews");
                    s.id = "";
                    var c = s.innerHTML;
                    s.parentNode.removeChild(s);
                    var d = {
                        headers: {"X-CSRF-TOKEN": e('meta[name="csrf-token"]').attr("content")},
                        url: l,
                        method: "POST",
                        paramName: "file",
                        filesizeBase: 1024,
                        maxFilesize: parseInt(getUploadConfig.maxFileSize),
                        maxFiles: parseInt(getUploadConfig.maxUploadFiles),
                        previewTemplate: c,
                        autoProcessQueue: !1,
                        clickable: document.querySelector(".uploadbox-drag .uploadbox-drag-inner"),
                        parallelUploads: parseInt(getUploadConfig.maxUploadFiles),
                        timeout: 0,
                        chunking: !0,
                        forceChunking: !0,
                        chunkSize: parseInt(getUploadConfig.chunkSize),
                        retryChunks: !0,
                        hiddenInputContainer: document.querySelector(".uploadbox-drag")
                    };
                    d = Object.assign({}, d, dropzoneOptions);
                    Dropzone.autoDiscover = !1;
                    var u = new Dropzone("#dropzone", d);
                    u.element.querySelector(".dz-message").remove(), e(".dz-hidden-input").attr("title", ""), window.addEventListener("change", (function () {
                        e(".dz-hidden-input").attr("title", "")
                    })), document.querySelectorAll("[data-dz-click]").forEach((function (e) {
                        e.onclick = function (e) {
                            e.preventDefault(), document.querySelector(".dz-hidden-input").click()
                        }
                    }));
                    var f = e(".upload-more-btn"), p = e(".uploadbox-wrapper-form"), h = e(".upload-files-btn"),
                        m = e(".upload-auto-delete");
                    h.on("click", (function (e) {
                        (e.preventDefault(), u.files.length > 0) ? "" != getUploadConfig.filesDuration && m.find(":selected").data("action") > getUploadConfig.filesDuration ? toastr.error(getUploadConfig.filesDurationError) : (h.prop("disabled", !0), p.addClass("d-none"), f.addClass("d-none"), u.processQueue()) : toastr.error(getUploadConfig.nofilesAttachedError)
                    }));
                    var v = e(".reset-upload-box");
                    v.on("click", (function () {
                        u.removeAllFiles(!0)
                    })), u.on("addedfile", (function (t) {
                        if (0 != getUploadConfig.subscribed && 1 != getUploadConfig.subscriptionExpired && 1 != getUploadConfig.subscriptionCanceled) if (u.files.length <= getUploadConfig.maxUploadFiles) {
                            var o = getUploadConfig.unacceptableFileTypes.split(","), r = "." + a(t.name);
                            if (o.includes(r)) this.removeFile(t), toastr.error(getUploadConfig.unacceptableFileTypesError); else {
                                var l, s;
                                if (this.files.length) for (l = 0, s = this.files.length; l < s - 1; l++) this.files[l].name === t.name && (this.removeFile(t), toastr.error(getUploadConfig.fileDuplicateError));
                                0 == t.size && (toastr.error(getUploadConfig.emptyFilesError), this.removeFile(t)), "" != getUploadConfig.maxFileSize && t.size > getUploadConfig.maxFileSize && (toastr.error(getUploadConfig.exceedTheAllowedSizeError), this.removeFile(t)), "" != getUploadConfig.clientReminingSpace && t.size > getUploadConfig.clientReminingSpace && (toastr.error(getUploadConfig.clientReminingSpaceError), this.removeFile(t)), n(), u.files.length == getUploadConfig.maxUploadFiles && f.addClass("d-none");
                                var c = e(t.previewElement), d = c.find(".dz-file-edit"), p = c.find("[data-dz-edit]"),
                                    h = c.find(".dz-edit .fa"), m = c.find(".dz-file-edit-close"),
                                    v = c.find(".dz-file-edit-submit"), g = c.find(".file-password");
                                g.on("input", (function () {
                                    g.removeClass("is-invalid")
                                })), p.on("click", (function () {
                                    "" != g.val() && g.attr("fill-status", !0), g.prop("disabled", !1), d.addClass("active")
                                })), m.on("click", (function () {
                                    "" == g.val() ? (g.prop("disabled", !0), g.attr("fill-status", !1), h.removeClass("fa-lock"), h.addClass("fa-lock-open")) : "false" == g.attr("fill-status") && (g.val(""), g.prop("disabled", !0), h.removeClass("fa-lock"), h.addClass("fa-lock-open")), g.removeClass("is-invalid"), d.removeClass("active")
                                })), v.on("click", (function () {
                                    "" == g.val() ? g.addClass("is-invalid") : (h.addClass("fa-lock"), h.removeClass("fa-lock-open"), d.removeClass("active"))
                                }));
                                var w = c.find("[data-dz-name]"), y = c.find(".dz-size"),
                                    b = c.find("[data-dz-extension]"), C = r.replace(".", "");
                                w.html(t.name), y.html(i(t.size)), "" != C ? b.attr("data-type", C.substring(0, 4)) : b.attr("data-type", "?");
                                var k = document.querySelectorAll(".dz-file-edit-box-body");
                                k && k.forEach((function (e) {
                                    new PerfectScrollbar(e), e.classList.remove("ps--active-y"), e.classList.remove("ps--active-x")
                                }))
                            }
                        } else this.removeFile(t); else 1 != getUploadConfig.subscribed ? toastr.error(getUploadConfig.unsubscribedError) : 1 == getUploadConfig.subscriptionExpired ? toastr.error(getUploadConfig.subscriptionExpiredError) : 1 == getUploadConfig.subscriptionCanceled && toastr.error(getUploadConfig.subscriptionCanceledError), this.removeFile(t)
                    })), u.on("sending", (function (t, o, n) {
                        var i = e(t.previewElement), a = i.find(".dz-remove"), r = i.find(".dz-edit"),
                            l = i.find(".dz-file-edit"), s = i.find(".file-password");
                        n.append("size", t.size), s.length && n.append("password", s.val()), n.append("upload_auto_delete", e(".upload-auto-delete").val()), a.remove(), r.remove(), l.remove()
                    })), u.on("uploadprogress", (function (t, o, n) {
                        e(t.previewElement).find(".dz-upload-precent").html(o.toFixed(0) + "%")
                    })), u.on("error", (function (e) {
                        var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null;
                        toastr.error(t)
                    })), u.on("complete", (function (t) {
                        if ("success" == t.status) {
                            var o = e(t.previewElement), n = JSON.parse(t.xhr.response);
                            if ("success" == n.type) {
                                var i = o.find(".dz-preview-container");
                                null != n.preview_link && i.append('<div class="mt-3"><label class="form-label fw-500">' + getUploadConfig.translation.previewLink + '</label><div class="form-group"><input id="filebob' + n.preview_id + '" type="text" class="form-control form-control-md" value="' + n.preview_link + '" readonly> <button type="button" class="btn-copy" data-clipboard-target="#filebob' + n.preview_id + '"><i class="far fa-clone"></i></button></div></div>'), i.append('<div class="mt-3"><label class="form-label fw-500">' + getUploadConfig.translation.downloadLink + '</label><div class="form-group"><input id="filebob' + n.download_id + '" type="text" class="form-control form-control-md" value="' + n.download_link + '" readonly> <button type="button" class="btn-copy" data-clipboard-target="#filebob' + n.download_id + '"><i class="far fa-clone"></i></button></div></div>'), i.append('<a href="' + n.download_link + '" target="_blank" class="btn btn-primary w-100 btn-md mt-3"><i class="fas fa-eye me-2"></i>' + getUploadConfig.translation.viewFile + "</a>"), r()
                            } else o.removeClass("dz-success"), o.addClass("dz-error"), toastr.error(n.msg)
                        }
                    })), u.on("removedfile", (function () {
                        n()
                    }))
                }
            }(jQuery)
        }, 346: () => {
            !function (e) {
                "use strict";
                var t, o, n = new Image, i = document.querySelector(".fileviewer-image img"), a = .2, r = !1,
                    l = document.querySelector(".fileviewer-controler"),
                    s = document.querySelector(".fileviewer-image");
                if (s) {
                    var c = function () {
                        "rp-90" === o || "rp-270" === o || "rm-90" === o || "rm-270" === o ? (r = !0, f(), p()) : u()
                    }, d = function () {
                        s.removeAttribute("style")
                    }, u = function () {
                        var e = window.innerHeight - 120, o = e * t;
                        window.innerWidth < 1921 ? n.width > window.innerWidth - 120 || n.height > window.innerHeight - 120 ? o > window.innerWidth ? (i.style.height = (window.innerWidth - 32) / t + "px", i.style.width = window.innerWidth - 32 + "px") : (i.style.height = e + "px", i.style.width = o + "px") : (i.style.height = n.height + "px", i.style.width = n.width + "px") : n.width > window.innerWidth - 120 || n.height > window.innerHeight - 120 ? (i.style.height = window.innerHeight - 120 + "px", i.style.width = (window.innerHeight - 120) * t + "px") : (i.style.height = n.height + "px", i.style.width = n.width + "px")
                    }, f = function () {
                        var e = window.innerHeight - 120, o = e / t;
                        window.innerWidth < 1921 ? n.width > window.innerHeight - 120 || n.height > window.innerWidth - 120 ? e > window.innerWidth ? (i.style.height = (window.innerWidth - 32) / t + "px", i.style.width = window.innerWidth - 32 + "px") : (i.style.height = o + "px", i.style.width = e + "px") : (i.style.height = n.height + "px", i.style.width = n.width + "px") : n.width > window.innerHeight - 120 || n.height > window.innerWidth - 120 ? (i.style.height = (window.innerHeight - 120) / t + "px", i.style.width = window.innerHeight - 120 + "px") : (i.style.height = n.width / t + "px", i.style.width = n.width + "px")
                    }, p = function () {
                        if (!0 === r) {
                            if (s.style.position = "relative", s.style.left = 0, s.style.width = i.height + "px", s.style.height = i.width + "px", s.style.overflow = "hidden", s.offsetLeft < 0) {
                                var e = -1 * s.offsetLeft;
                                s.style.left = e + "px"
                            }
                        } else if (s.style.position = "relative", s.style.left = 0, s.offsetLeft < 0) {
                            var t = -1 * s.offsetLeft;
                            s.style.left = t + "px"
                        }
                    };
                    o = i.className, n.src = i.src, window.addEventListener("load", (function () {
                        t = n.naturalWidth / n.naturalHeight
                    }));
                    var h = l.querySelector(".rotate-left"), m = l.querySelector(".rotate-right"),
                        v = l.querySelector(".zoom-in"), g = l.querySelector(".zoom-out");
                    u(), h.addEventListener("click", (function () {
                        d(), i.classList.contains("r-0") ? (i.removeAttribute("class"), i.classList.add("rm-90"), r = !0, f(), p()) : i.classList.contains("rm-90") ? (i.removeAttribute("class"), i.classList.add("rm-180"), r = !1, u()) : i.classList.contains("rm-180") ? (i.removeAttribute("class"), i.classList.add("rm-270"), r = !0, f(), p()) : i.classList.contains("rm-270") || i.classList.contains("rp-90") ? (i.removeAttribute("class"), i.classList.add("r-0"), r = !1, u()) : i.classList.contains("rp-180") ? (i.removeAttribute("class"), i.classList.add("rp-90"), r = !0, f(), p()) : i.classList.contains("rp-270") && (i.removeAttribute("class"), i.classList.add("rp-180"), r = !1, u())
                    })), m.addEventListener("click", (function () {
                        d(), i.classList.contains("r-0") ? (i.removeAttribute("class"), i.classList.add("rp-90"), r = !0, f(), p()) : i.classList.contains("rp-90") ? (i.removeAttribute("class"), i.classList.add("rp-180"), r = !1, u()) : i.classList.contains("rp-180") ? (i.removeAttribute("class"), i.classList.add("rp-270"), r = !0, f(), p()) : i.classList.contains("rp-270") || i.classList.contains("rm-90") ? (i.removeAttribute("class"), i.classList.add("r-0"), r = !1, u()) : i.classList.contains("rm-180") ? (i.removeAttribute("class"), i.classList.add("rm-90"), r = !0, f(), p()) : i.classList.contains("rm-270") && (i.removeAttribute("class"), i.classList.add("rm-180"), r = !1, u())
                    })), v.addEventListener("click", (function () {
                        i.width <= n.width - (i.width - i.width * a) || i.height <= n.height - (i.height - i.height * a) ? (i.style.height = 1.2 * i.height + "px", i.style.width = 1.2 * i.width + "px") : (i.style.height = n.width / t + "px", i.style.width = n.width + "px"), p()
                    })), g.addEventListener("click", (function () {
                        i.width >= 150 && i.height >= 150 && (i.style.height = i.height / 1.2 + "px", i.style.width = i.width / 1.2 + "px", d()), p()
                    })), window.addEventListener("load", c), window.addEventListener("click", (function () {
                        !0 === r ? i.width > window.innerHeight && i.height > window.innerWidth ? (document.body.classList.add("overflow-x-auto"), document.body.classList.add("overflow-y-auto")) : i.height > window.innerWidth ? (document.body.classList.add("overflow-x-auto"), document.body.classList.remove("overflow-y-auto")) : i.width > window.innerHeight && (document.body.classList.add("overflow-y-auto"), document.body.classList.remove("overflow-x-auto")) : i.width > window.innerWidth && i.height > window.innerHeight ? (document.body.classList.add("overflow-x-auto"), document.body.classList.add("overflow-y-auto")) : i.width > window.innerWidth ? (document.body.classList.add("overflow-x-auto"), document.body.classList.remove("overflow-y-auto")) : i.height > window.innerHeight && (document.body.classList.add("overflow-y-auto"), document.body.classList.remove("overflow-x-auto"))
                    })), window.addEventListener("resize", u), window.addEventListener("resize", (function () {
                        i.removeAttribute("class"), i.classList.add(o), r = !1, d()
                    })), window.addEventListener("resize", c), f()
                }
                var w = document.querySelector(".fileviewer-file"), y = document.querySelector(".contextmenu");
                w && (w.oncontextmenu = function (e) {
                    e.preventDefault(), y.classList.add("show"), window.innerWidth - e.clientX < y.clientWidth && window.innerHeight - e.clientY < y.clientHeight ? (y.removeAttribute("style"), y.style.right = window.innerWidth - e.clientX + "px", y.style.bottom = window.innerHeight - e.clientY + "px") : window.innerWidth - e.clientX < y.clientWidth ? (y.removeAttribute("style"), y.style.top = e.clientY + "px", y.style.right = window.innerWidth - e.clientX + "px") : window.innerHeight - e.clientY < y.clientHeight ? (y.removeAttribute("style"), y.style.bottom = window.innerHeight - e.clientY + "px", y.style.left = e.clientX + "px") : (y.removeAttribute("style"), y.style.top = e.clientY + "px", y.style.left = e.clientX + "px")
                }, window.addEventListener("click", (function () {
                    y.classList.remove("show")
                })), y.querySelectorAll(".contextmenu-item").forEach((function (e) {
                    e.oncontextmenu = function (e) {
                        e.preventDefault()
                    }
                })))
            }(jQuery)
        }, 219: () => {
            !function (e) {
                "use strict";
                document.querySelectorAll("[data-year]").forEach((function (e) {
                    e.textContent = (new Date).getFullYear()
                })), window.AOS && AOS.init({
                    once: !0,
                    disable: "mobile"
                }), e.LoadingOverlaySetup && e.LoadingOverlaySetup({
                    imageColor: getConfig.LoadingOverlayColor,
                    size: 10,
                    zIndex: 1100
                });
                var t = document.querySelector("#copy-btn");
                t && new ClipboardJS(t).on("success", (function (e) {
                    toastr.success(getConfig.copiedToClipboardSuccess)
                }));
                window.clipboardByClass = function () {
                    var e = document.querySelectorAll(".copy");
                    e && e.forEach((function (e) {
                        new ClipboardJS(e).on("success", (function () {
                            toastr.success(getConfig.copiedToClipboardSuccess)
                        }))
                    }))
                }, window.clipboardByClass();
                var o = document.querySelector("#country"), n = e("#mobile"),
                    i = document.querySelector("#mobile_code");
                if (o) {
                    var a = o.querySelector('option[data-code="'.concat(getConfig.countryCode, '"]')),
                        r = i.querySelector('option[data-code="'.concat(getConfig.countryCode, '"]'));
                    a.selected = !0, r.selected = !0, o.addEventListener("change", (function () {
                        i.querySelector('option[data-code="'.concat(o.options[o.selectedIndex].getAttribute("data-code"), '"]')).selected = !0
                    })), i.addEventListener("change", (function () {
                        o.querySelector('option[data-code="'.concat(i.options[i.selectedIndex].getAttribute("data-code"), '"]')).selected = !0
                    }))
                }
                n.length && n.on("propertychange input", (function () {
                    var t = e(this);
                    t.val(t.val().replace(/[^\d]+/g, ""))
                }));
                var l = document.querySelectorAll("[data-dropdown]");
                null != l && l.forEach((function (e) {
                    window.addEventListener("click", (function (t) {
                        e.contains(t.target) ? (e.classList.toggle("active"), setTimeout((function () {
                            e.classList.toggle("animated")
                        }), 0)) : (e.classList.remove("active"), e.classList.remove("animated"))
                    }))
                }));
                var s = document.querySelector(".nav-bar");
                if (s) {
                    var c = function () {
                        window.scrollY > 100 ? s.classList.add("active") : s.classList.remove("active")
                    };
                    window.addEventListener("load", c), window.addEventListener("scroll", c)
                }
                var d = document.querySelector(".nav-bar-menu"), u = document.querySelector(".nav-bar-menu-icon"),
                    f = function () {
                        d.classList.remove("active"), document.body.style.overflowY = "auto"
                    };
                d && (u.onclick = function () {
                    d.classList.add("active"), document.body.style.overflowY = "hidden"
                }, d.querySelector(".btn-close").onclick = function () {
                    f()
                }, d.querySelector(".overlay").onclick = function () {
                    f()
                }, d.querySelectorAll(".nav-bar-link").forEach((function (e) {
                    e.onclick = function () {
                        f()
                    }
                })));
                var p = document.querySelectorAll("[data-link]"), h = document.querySelectorAll("[data-go-top]");
                p && p.forEach((function (e) {
                    e.onclick = function (t) {
                        t.preventDefault();
                        var o = document.querySelector(e.getAttribute("data-link")).offsetTop - 60;
                        f(), window.scrollTo("0", o)
                    }
                })), h && h.forEach((function (e) {
                    e.onclick = function (e) {
                        e.preventDefault(), f(), window.scrollTo("0", "0")
                    }
                }));
                var m = document.querySelectorAll("[ps]");
                m && m.forEach((function (e) {
                    new PerfectScrollbar(e), e.classList.remove("ps--active-x")
                }));
                var v = e(".filebox-download");
                if (e(".download-counter").length) var g = e(".counter-number"), w = setInterval((function () {
                    g.html(Number(g.html()) - 1), 0 == g.html() && (clearInterval(w), y())
                }), 1e3);
                var y = function () {
                    var t = getConfig.baseURL + "/" + downloadId + "/download/create";
                    e.ajax({
                        headers: {"X-CSRF-TOKEN": e('meta[name="csrf-token"]').attr("content")},
                        url: t,
                        type: "POST",
                        dataType: "json",
                        success: function (t) {
                            e.isEmptyObject(t.error) ? (v.empty(), v.append('<a class="download-link" href="' + t.download_link + '">' + downloadBtnTxt + "</a>"), b()) : toastr.error(t.error)
                        }
                    })
                }, b = function () {
                    e(".download-link").on("click", (function (t) {
                        t.preventDefault(), v.empty(), v.append('<button class="downloading-btn" disabled>' + downloadingBtnTxt + "</button>"), location.href = e(this).attr("href"), setTimeout((function () {
                            v.empty(), v.append('<button class="reDownload-btn" disabled>' + reDownloadBtnTxt + '&nbsp;<a id="reDownloadBtn" href="#">' + clickHereTxt + "<a></button>"), C()
                        }), 2e3)
                    }))
                }, C = function () {
                    e("#reDownloadBtn").on("click", (function (e) {
                        e.preventDefault(), y()
                    }))
                };
                "undefined" != typeof downloadWaitingTime && 0 == downloadWaitingTime && b();
                [].slice.call(document.querySelectorAll('[rel="tooltip"]')).map((function (e) {
                    return new bootstrap.Tooltip(e)
                }));
                var k = document.querySelectorAll(".plans .plans-item"), S = document.querySelector(".plan-switcher");
                S && S.querySelectorAll(".plan-switcher-item").forEach((function (e, t) {
                    e.onclick = function () {
                        S.querySelectorAll(".plan-switcher-item").forEach((function (e) {
                            e.classList.remove("active")
                        })), e.classList.add("active"), k.forEach((function (e) {
                            e.classList.remove("active")
                        })), k[t].classList.add("active")
                    }
                })), window.passwordEye = function () {
                    var e = document.querySelectorAll(".input-password");
                    e && e.forEach((function (e) {
                        var t = e.querySelector("button"), o = e.querySelector("input");
                        t.onclick = function (e) {
                            e.preventDefault(), "password" === o.type ? (o.type = "text", t.innerHTML = '<i class="fas fa-eye-slash"></i>') : (o.type = "password", t.innerHTML = '<i class="fas fa-eye"></i>')
                        }
                    }))
                }, window.passwordEye(), e(".confirm-action").on("click", (function (t) {
                    var o = this;
                    t.preventDefault(), Swal.fire({
                        title: getConfig.alertActionTitle,
                        text: getConfig.alertActionText,
                        icon: "question",
                        showCancelButton: !0,
                        allowOutsideClick: !1,
                        focusConfirm: !1,
                        confirmButtonText: getConfig.alertActionConfirmButton,
                        confirmButtonColor: getConfig.primaryColor,
                        cancelButtonText: getConfig.alertActionCancelButton
                    }).then((function (t) {
                        t.isConfirmed && (location.href = e(o).attr("href"))
                    }))
                })), e(".confirm-action-form").on("click", (function (t) {
                    var o = this;
                    t.preventDefault(), Swal.fire({
                        title: getConfig.alertActionTitle,
                        text: getConfig.alertActionText,
                        icon: "question",
                        showCancelButton: !0,
                        allowOutsideClick: !1,
                        focusConfirm: !1,
                        confirmButtonText: getConfig.alertActionConfirmButton,
                        confirmButtonColor: getConfig.primaryColor,
                        cancelButtonText: getConfig.alertActionCancelButton
                    }).then((function (t) {
                        t.isConfirmed && e(o).parents("form")[0].submit()
                    }))
                })), e("#otp-code").on("input", (function () {
                    this.value = this.value.replace(/\D/g, "")
                }));
                var x = document.querySelectorAll(".swiper-video");
                if (document.querySelector(".swiper")) new Swiper(".swiper", {
                    autoplay: !0,
                    allowTouchMove: !1,
                    effect: "fade",
                    fadeEffect: {crossFade: !1},
                    on: {
                        init: function () {
                            x && this.slides[this.realIndex].classList.contains("swiper-video") && this.slides[this.realIndex].querySelector("video").play()
                        }, slideChange: function () {
                            x && x.forEach((function (e) {
                                e.querySelector("video").load()
                            }))
                        }, slideChangeTransitionStart: function () {
                            this.slides[this.realIndex].classList.contains("swiper-video") && this.slides[this.realIndex].querySelector("video").play()
                        }
                    }
                })
            }(jQuery)
        }, 598: () => {
            !function (e) {
                "use strict";
                var t = document.getElementById("pdfCanvas");
                t && (PDFJS.GlobalWorkerOptions.workerSrc = getConfig.baseURL + "/assets/vendor/libs/pdf/pdf.worker.min.js", function (e, t, o) {
                    function n(e) {
                        var n = e.getViewport(o.scale), i = document.createElement("div");
                        i.className = "canvas-wrapper";
                        var a = document.createElement("canvas"), r = {canvasContext: a.getContext("2d"), viewport: n};
                        a.height = n.height, a.width = n.width, i.appendChild(a), t.appendChild(i), e.render(r)
                    }

                    function i(e) {
                        for (var t = 1; t <= e.numPages; t++) e.getPage(t).then(n)
                    }

                    function a() {
                        document.querySelectorAll(".canvas-wrapper").forEach((function (e, t) {
                            e.offsetTop - e.offsetHeight / 2 <= window.scrollY && (document.getElementById("page_num").textContent = t + 1)
                        }))
                    }

                    o = o || {scale: 1.5}, PDFJS.disableWorker = !0, PDFJS.getDocument(e).then(i), PDFJS.getDocument(e).promise.then((function (e) {
                        var t = e;
                        document.getElementById("page_count").textContent = t.numPages
                    })), document.getElementById("page_num").textContent = 1, window.addEventListener("scroll", a)
                }(document.querySelector(".fileviewer-pdf").getAttribute("data-pdfDoc"), t))
            }(jQuery)
        }, 759: () => {
        }, 272: () => {
        }, 418: () => {
        }
    }, o = {};

    function n(e) {
        var i = o[e];
        if (void 0 !== i) return i.exports;
        var a = o[e] = {exports: {}};
        return t[e](a, a.exports, n), a.exports
    }

    n.m = t, e = [], n.O = (t, o, i, a) => {
        if (!o) {
            var r = 1 / 0;
            for (d = 0; d < e.length; d++) {
                for (var [o, i, a] = e[d], l = !0, s = 0; s < o.length; s++) (!1 & a || r >= a) && Object.keys(n.O).every((e => n.O[e](o[s]))) ? o.splice(s--, 1) : (l = !1, a < r && (r = a));
                if (l) {
                    e.splice(d--, 1);
                    var c = i();
                    void 0 !== c && (t = c)
                }
            }
            return t
        }
        a = a || 0;
        for (var d = e.length; d > 0 && e[d - 1][2] > a; d--) e[d] = e[d - 1];
        e[d] = [o, i, a]
    }, n.o = (e, t) => Object.prototype.hasOwnProperty.call(e, t), (() => {
        var e = {507: 0, 493: 0, 554: 0, 188: 0};
        n.O.j = t => 0 === e[t];
        var t = (t, o) => {
            var i, a, [r, l, s] = o, c = 0;
            if (r.some((t => 0 !== e[t]))) {
                for (i in l) n.o(l, i) && (n.m[i] = l[i]);
                if (s) var d = s(n)
            }
            for (t && t(o); c < r.length; c++) a = r[c], n.o(e, a) && e[a] && e[a][0](), e[r[c]] = 0;
            return n.O(d)
        }, o = self.webpackChunk = self.webpackChunk || [];
        o.forEach(t.bind(null, 0)), o.push = t.bind(null, o.push.bind(o))
    })(), n.O(void 0, [493, 554, 188], (() => n(124))), n.O(void 0, [493, 554, 188], (() => n(759))), n.O(void 0, [493, 554, 188], (() => n(272)));
    var i = n.O(void 0, [493, 554, 188], (() => n(418)));
    i = n.O(i)
})();