
	var gBACKCOLOR ="#ccf533";
	var gTEXTBACKCOLOR ="#e99bff";

	function CompareById(v_nodeID1, v_nodeID2)
	{
		var LeftContentObj = document.getElementById(v_nodeID1);
		var RightContentObj = document.getElementById(v_nodeID2);

		var LeftNodesList = new Array;
		LeftNodesList = GetAllTextNodes(LeftContentObj);

		var RightNodesList = new Array;
		RightNodesList = GetAllTextNodes(RightContentObj);

		CompareNodes(LeftNodesList, RightNodesList);
	}
	function Equal(v_node1, v_node2)
	{
		if (v_node1.data == v_node2.data)
		 return true;
		return false;
	}
	function CompareText(v_LeftList, v_RightList)
	{
		var leftLen = v_LeftList.length;
		var rightLen = v_RightList.length;
		if (rightLen == leftLen && 1 == rightLen)
		{	
			if (v_LeftList[0].data.length==v_RightList[0].data.length && 1==v_RightList[0].data.length )
				return;
		}
		if (0 == leftLen)
		{
			for (var i = 0; i < rightLen; i++)
				PaintNode(v_RightList[i], gTEXTBACKCOLOR);
		}
		else if (0 == rightLen)
		{
			for (var i = 0; i < leftLen; i++)
				PaintNode(v_LeftList[i], gTEXTBACKCOLOR);
		}
		else
		{
			//--------------------compare text--------------------
			var LeftTextList = new Array;
			LeftTextList = GetCharList(v_LeftList);
			var RightTextList = new Array;
			RightTextList = GetCharList(v_RightList);

			var ResultList = new Array;
			ResultList = CompareChars(LeftTextList, RightTextList);	
			if (0 != ResultList[0].length || 0 != ResultList[1].length)
			{
				for (var i = 0; i < v_LeftList.length; i++)
					v_LeftList[i] = PaintNode(v_LeftList[i], gBACKCOLOR);
					
				for (var i = 0; i < v_RightList.length; i++)
					v_RightList[i] = PaintNode(v_RightList[i], gBACKCOLOR);					
			}	

			Display(ResultList[0], v_LeftList);
			Display(ResultList[1], v_RightList);
			//------------------------END-------------------------
		}			
	}
	
	function GetCharList(v_nodeList)
	{
		var CharList = new Array;
		for (var i = 0; i < v_nodeList.length; i++)
		{
			var text = v_nodeList[i].data;
			for (var j = 0; j < text.length; j++)
			{
				CharList[CharList.length] = text.charAt(j);
			}
		}
		return CharList;
	}
	function Display(v_posList, v_nodeList)
	{
		var NodeTextList = new Array;			
		if (0 == v_posList.length)
			return;
			
		for (var i = 0; i < v_nodeList.length; i++)
		{
			NodeTextList.length = 0;
			var splitPos = new Array;
			if (1 == v_nodeList.length)
				splitPos = v_posList;
			else
			{	
				var begin = 0;
				if (i > 0)
				{
					for (var k = 0; k < i; k++)
						begin += v_nodeList[k].data.length;
				}
				splitPos = GetSplitPosList(v_posList, v_nodeList[i].data.length, begin); 
 			}		
					
			NodeTextList = SplitTexe(splitPos, v_nodeList[i].data); 
			PaintText(v_nodeList[i], NodeTextList, gTEXTBACKCOLOR);
		}	
	}
	
	function GetSplitPosList(v_list, v_len, v_begin)
	{
		var splitPos = new Array;
	