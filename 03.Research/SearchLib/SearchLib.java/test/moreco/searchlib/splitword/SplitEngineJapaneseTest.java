package moreco.searchlib.splitword;

class SplitEngineJapaneseTest {

	public static void main(String[] args) {
    	SplitEngineJapanese tester = new SplitEngineJapanese();

    	System.out.println(tester.isUsableWord("へ"));
    	System.out.println(tester.isUsableWord("日"));
    	System.out.println(tester.isUsableWord("日本"));

    }
}
