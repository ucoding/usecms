<!--左边-->
<div id="nav">
<ul id="tree" class="ztree load">

</ul>
</div>
<script>
    var zTree;
    var setting = {
        view: {
            showLine: true,
            selectedMulti: false
        },
        data: {
            simpleData: {
                enable: true,
                idKey: "cid",
                pIdKey: "pid",
                rootPId: ""
            }
        },
        callback: {
            onClick: onClick
        }
    };
    var zNodes = [
        <?php echo $class_tree; ?>
    ];

    function onClick(e, treeId, treeNode) {
        var zTree = $.fn.zTree.getZTreeObj("tree");
        if (treeNode.url == null) {
            zTree.expandNode(treeNode);
        }

    }
    $(document).ready(function () {
        function filter(node) {
            return (node.url != null);
        }

        var t = $("#tree");
        t = $.fn.zTree.init(t, setting, zNodes);
        t.expandAll(true);
        ajaxload('__APP__/content_index');
    });
</script>    
